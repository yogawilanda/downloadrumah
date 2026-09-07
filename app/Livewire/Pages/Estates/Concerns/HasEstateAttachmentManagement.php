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
    }

    public function setPrimaryPhoto(int $attachmentId): void
    {
        if (!$this->form->isEdit() || $this->form->estate?->user_id !== Auth::id()) {
            abort(403);
        }

        DB::transaction(function () use ($attachmentId) {
            // Reset semua foto estate ini jadi false
            EstateAttachment::where('estate_id', $this->form->estate->id)
                ->update(['is_primary' => false]);

            // Set foto terpilih jadi primary
            EstateAttachment::where('id', $attachmentId)
                ->where('estate_id', $this->form->estate->id)
                ->update(['is_primary' => true]);
        });

        // Sync ulang state array di memory
        foreach ($this->existingPhotos as &$photo) {
            $photo['is_primary'] = ($photo['id'] === $attachmentId);
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

            // Jika foto utama dihapus, pindahkan primary ke foto pertama yang tersisa
            if ($wasPrimary && !empty($this->existingPhotos)) {
                $nextPrimaryId = $this->existingPhotos[0]['id'];
                $this->setPrimaryPhoto($nextPrimaryId);
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

            $attachment = EstateAttachment::create([
                'estate_id' => $targetEstate->id,
                'file_path' => $path,
                'is_primary' => (!$hasPrimary && $index === 0),
            ]);

            $this->existingPhotos[] = $attachment->toArray();

            if (!$hasPrimary && $index === 0) {
                $hasPrimary = true;
            }
        }

        $this->photos = [];
        $this->resetErrorBag('photos');
    }
}
