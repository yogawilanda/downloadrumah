<?php

namespace App\Livewire\Pages\Estates\Concerns;

use App\Models\EstateAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait HasEstateAttachmentManagement
{
    public array $existingPhotos = [];
    public array $photos = [];

    // State penanda primary photo ('existing' / 'new')
    public string $primaryPhotoType = 'existing';
    public int|string $primaryPhotoIndex = 0;

    public function updatedPhotos(): void
    {
        $totalExisting = count($this->existingPhotos);
        $totalNew = count($this->photos);

        if (($totalExisting + $totalNew) > 8) {
            $allowedCount = max(0, 8 - $totalExisting);
            $this->photos = array_slice($this->photos, 0, $allowedCount);
            $this->addError('photos', 'Total foto maksimal 8. Foto berlebih telah dipotong.');
        } else {
            $this->resetErrorBag('photos');
        }
    }

    public function removePhoto(int $index): void
    {
        array_splice($this->photos, $index, 1);
        $this->resetErrorBag('photos');

        // Jika foto temporary utama dihapus, reset pilihan primary ke foto eksisting pertama
        if ($this->primaryPhotoType === 'new' && $this->primaryPhotoIndex === $index) {
            $this->primaryPhotoType = 'existing';
            if (!empty($this->existingPhotos)) {
                $this->setPrimaryPhoto('existing', $this->existingPhotos[0]['id']);
            }
        }
    }

    /**
     * Set foto utama dari foto tersimpan (DB) maupun foto temporary (Upload Baru).
     * Usage: setPrimaryPhoto('existing', $photoId) ATAU setPrimaryPhoto('new', $index)
     */
    public function setPrimaryPhoto(string $type, int|string $targetKey): void
    {
        $this->primaryPhotoType = $type;
        $this->primaryPhotoIndex = $targetKey;

        // Jika tipe 'existing', reset semua foto di state memori & DB
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
            // Jika tipe 'new', hilangkan semua tanda is_primary di existingPhotos
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

            // Jika foto utama yang di-delete, pindahkan primary ke foto pertama tersisa
            if ($wasPrimary && !empty($this->existingPhotos)) {
                $nextPrimaryId = $this->existingPhotos[0]['id'];
                $this->setPrimaryPhoto('existing', $nextPrimaryId);
            }
        }
    }

    protected function storeUploadedPhotos($targetEstate): void
    {
        if (empty($this->photos)) {
            return;
        }

        $hasPrimary = $targetEstate->attachments()->where('is_primary', true)->exists();

        foreach ($this->photos as $index => $photo) {
            $path = $photo->store('estates', 'public');

            // Logika penentuan foto utama saat upload permanen
            $isThisPrimary = ($this->primaryPhotoType === 'new' && $this->primaryPhotoIndex == $index)
                || (!$hasPrimary && $index === 0 && $this->primaryPhotoType !== 'existing');

            if ($isThisPrimary) {
                // Unset primary lama di DB jika foto baru terpilih jadi primary
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

        // Reset state temporary
        $this->photos = [];
        $this->primaryPhotoType = 'existing';
        $this->resetErrorBag('photos');
    }
}
