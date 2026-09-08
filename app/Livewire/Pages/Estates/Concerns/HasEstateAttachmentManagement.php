<?php

namespace App\Livewire\Pages\Estates\Concerns;

use App\Models\EstateAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait HasEstateAttachmentManagement
{
    public array $existingPhotos = [];

    /** @var TemporaryUploadedFile[] Landing area batch baru dari Livewire upload */
    public array $photos = [];

    /** @var TemporaryUploadedFile[] Penampung akumulasi semua file temporary */
    public array $tempPhotos = [];

    // State penanda primary photo ('existing' / 'new')
    public string $primaryPhotoType = 'existing';
    public int|string $primaryPhotoIndex = 0;

    /**
     * Hook dipanggil setiap kali ada batch upload baru masuk ke $photos
     */
    public function updatedPhotos(): void
    {
        if (empty($this->photos)) {
            return;
        }

        // 1. Pindahkan & gabungkan batch baru dari $photos ke $tempPhotos
        foreach ($this->photos as $newPhoto) {
            $this->tempPhotos[] = $newPhoto;
        }

        // 2. Kosongkan landing area agar siap terima batch berikutnya
        $this->photos = [];

        // 3. Validasi kuota maks 8 foto (Existing + Temp)
        $totalExisting = count($this->existingPhotos);
        $totalTemp = count($this->tempPhotos);

        if (($totalExisting + $totalTemp) > 8) {
            $allowedCount = max(0, 8 - $totalExisting);
            $this->tempPhotos = array_slice($this->tempPhotos, 0, $allowedCount);
            $this->addError('photos', 'Total foto maksimal 8. Foto berlebih telah dipotong.');
        } else {
            $this->resetErrorBag('photos');
        }
    }

    public function removePhoto(int $index): void
    {
        if (isset($this->tempPhotos[$index])) {
            array_splice($this->tempPhotos, $index, 1);
            $this->tempPhotos = array_values($this->tempPhotos);
        }

        $this->resetErrorBag('photos');

        if ($this->primaryPhotoType === 'new') {
            if ($this->primaryPhotoIndex == $index) {
                $this->primaryPhotoType = 'existing';
                if (!empty($this->existingPhotos)) {
                    $this->setPrimaryPhoto('existing', $this->existingPhotos[0]['id']);
                }
            } elseif ($this->primaryPhotoIndex > $index) {
                $this->primaryPhotoIndex = (int) $this->primaryPhotoIndex - 1;
            }
        }
    }

    public function setPrimaryPhoto(string $type, int|string $targetKey): void
    {
        $this->primaryPhotoType = $type;
        $this->primaryPhotoIndex = $targetKey;

        if ($type === 'existing') {
            foreach ($this->existingPhotos as &$photo) {
                $photo['is_primary'] = ($photo['id'] == $targetKey);
            }

            if ($this->form->isEdit() && $this->form->estate?->user_id === Auth::id()) {
                DB::transaction(function () use ($targetKey) {
                    EstateAttachment::where('estate_id', $this->form->estate->id)
                        ->update(['is_primary' => false]);

                    EstateAttachment::where('id', $targetKey)
                        ->where('estate_id', $this->form->estate->id)
                        ->update(['is_primary' => true]);
                });
            }
        } else {
            foreach ($this->existingPhotos as &$photo) {
                $photo['is_primary'] = false;
            }
        }
    }

    public function deleteExistingPhoto(int $attachmentId): void
    {
        if (!$this->form->isEdit() || $this->form->estate?->user_id !== Auth::id()) {
            abort(403);
        }

        $attachment = EstateAttachment::where('id', $attachmentId)
            ->where('estate_id', $this->form->estate->id)
            ->first();

        if ($attachment) {
            $wasPrimary = $attachment->is_primary;

            DB::transaction(function () use ($attachment) {
                Storage::disk('public')->delete($attachment->file_path);
                $attachment->delete();
            });

            $this->existingPhotos = array_values(array_filter(
                $this->existingPhotos,
                fn($photo) => $photo['id'] !== $attachmentId
            ));

            if ($wasPrimary && !empty($this->existingPhotos)) {
                $nextPrimaryId = $this->existingPhotos[0]['id'];
                $this->setPrimaryPhoto('existing', $nextPrimaryId);
            }
        }
    }

    protected function storeUploadedPhotos($targetEstate): void
    {
        if (empty($this->tempPhotos)) {
            return;
        }

        $hasPrimary = $targetEstate->attachments()->where('is_primary', true)->exists();

        foreach ($this->tempPhotos as $index => $photo) {
            $path = $photo->store('estates', 'public');

            $isThisPrimary = ($this->primaryPhotoType === 'new' && $this->primaryPhotoIndex == $index)
                || (!$hasPrimary && $index === 0 && $this->primaryPhotoType !== 'existing');

            if ($isThisPrimary) {
                $targetEstate->attachments()->update(['is_primary' => false]);
                foreach ($this->existingPhotos as &$ex) {
                    $ex['is_primary'] = false;
                }
            }

            $attachment = EstateAttachment::create([
                'estate_id' => $targetEstate->id,
                'file_path' => $path,
                'is_primary' => $isThisPrimary,
            ]);

            $this->existingPhotos[] = $attachment->toArray();

            if ($isThisPrimary) {
                $hasPrimary = true;
            }
        }

        // Reset akumulator temporary setelah berhasil di-commit ke DB
        $this->tempPhotos = [];
        $this->primaryPhotoType = 'existing';
        $this->resetErrorBag('photos');
    }
}
