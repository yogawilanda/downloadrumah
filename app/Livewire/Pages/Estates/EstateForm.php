<?php

namespace App\Livewire\Pages\Estates;

use App\Livewire\Forms\EstateFormData;
use App\Models\Estate;
use App\Models\EstateAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
class EstateForm extends Component
{
    use WithFileUploads;

    // Livewire 3 otomatis meng-instansiasi properti ini
    public EstateFormData $form;

    public array $existingPhotos = [];
    public array $photos = [];

    public function mount(?Estate $estate = null): void
    {
        if ($estate && $estate->exists) {
            if ($estate->user_id !== Auth::id()) {
                abort(403);
            }

            $this->form->setEstate($estate);
            $this->existingPhotos = $estate->attachments->toArray();
        }
    }

    public function updatedPhotos(): void
    {
        $totalExisting = count($this->existingPhotos);
        $totalNew      = count($this->photos);

        if (($totalExisting + $totalNew) > 8) {
            $allowedCount = max(0, 8 - $totalExisting);
            $this->photos = array_slice($this->photos, 0, $allowedCount);

            $this->addError('photos', "Total foto maksimal 8. Foto berlebih telah dipotong.");
        } else {
            $this->resetErrorBag('photos');
        }
    }

    public function removePhoto(int $index): void
    {
        array_splice($this->photos, $index, 1);
        $this->resetErrorBag('photos');
    }

    public function deleteExistingPhoto(int $attachmentId): void
    {
        if (! $this->form->isEdit() || $this->form->estate?->user_id !== Auth::id()) {
            abort(403);
        }

        $attachment = EstateAttachment::where('id', $attachmentId)
            ->where('estate_id', $this->form->estate->id)
            ->first();

        if ($attachment) {
            DB::transaction(function () use ($attachment) {
                Storage::disk('public')->delete($attachment->file_path);
                $attachment->delete();
            });

            $this->existingPhotos = array_values(array_filter(
                $this->existingPhotos,
                fn($photo) => $photo['id'] !== $attachmentId
            ));
        }
    }

    public function save()
    {
        $this->form->validate();

        $maxNewPhotos = max(0, 8 - count($this->existingPhotos));
        $this->validate([
            'photos'   => "array|max:{$maxNewPhotos}",
            'photos.*' => 'image|max:3072',
        ]);

        $data = $this->form->toSqlData();

        DB::transaction(function () use ($data) {
            if ($this->form->isEdit()) {
                $this->form->estate->update($data);
                $targetEstate = $this->form->estate;
                $message      = 'Properti berhasil diperbarui!';
            } else {
                $data['user_id'] = Auth::id();
                $data['slug']    = Str::slug($this->form->title) . '-' . Str::random(5);
                $data['status']  = 'active';

                $targetEstate = Estate::create($data);
                $message      = 'Properti berhasil diterbitkan!';
            }

            foreach ($this->photos as $photo) {
                $path = $photo->store('estates', 'public');
                EstateAttachment::create([
                    'estate_id' => $targetEstate->id,
                    'file_path' => $path,
                ]);
            }

            session()->flash('success', $message);
        });

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.pages.estates.estate-form');
    }

    // Step untuk form
    public int $currentStep = 1;

    public function nextStep()
    {
        // Opsional: jalankan validasi parsial tiap step di sini kalau mau
        $this->currentStep = min(4, $this->currentStep + 1);
    }

    public function previousStep()
    {
        $this->currentStep = max(1, $this->currentStep - 1);
    }

    public function setStep($step)
    {
        $this->currentStep = $step;
    }
}
