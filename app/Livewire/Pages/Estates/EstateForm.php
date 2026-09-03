<?php

namespace App\Livewire\Pages\Estates;

use App\Livewire\Forms\EstateFormData;
use Laravolt\Indonesia\Models\City;
use App\Models\Estate;
use App\Models\EstateAttachment;
use Laravolt\Indonesia\Models\Province;
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

    public EstateFormData $form;

    public array $existingPhotos = [];
    public array $photos = [];

    // Step untuk form
    public int $currentStep = 1;

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

    // Reset pilihan city_id saat province_id berubah
    public function updatedFormProvinceId(): void
    {
        $this->form->city_id = null;
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
        try {
            // Validasi data utama dari form object
            $this->form->validate();

            // Hitung sisa kuota upload foto baru
            $totalExisting = count($this->existingPhotos);
            $allowedNewPhotos = max(0, 8 - $totalExisting);

            if (!empty($this->photos)) {
                $this->validate([
                    'photos'   => ['array', "max:{$allowedNewPhotos}"],
                    'photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
                ]);
            }

            // Minimal 1 foto
            if ($totalExisting === 0 && empty($this->photos)) {
                $this->addError('photos', 'Minimal unggah 1 foto listing agar properti bisa disimpan.');
                session()->flash('error', 'Gagal menyimpan properti. Unggah minimal 1 foto terlebih dahulu.');
                return;
            }

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

                // Upload foto baru jika ada
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            report($e);
            $this->addError('photos', 'Gagal mengirim properti. Periksa kembali data Anda.');
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
            return;
        }
    }

    public function render()
    {
        $provinces = Province::orderBy('name', 'asc')->get();

        // Pencarian kota aman berbasis code/id provinsi Laravolt
        $cities = collect();
        if ($this->form->province_id) {
            $province = Province::where('code', $this->form->province_id)
                ->orWhere('id', $this->form->province_id)
                ->first();

            if ($province) {
                $cities = City::where('province_code', $province->code)
                    ->orderBy('name', 'asc')
                    ->get();
            }
        }

        return view('livewire.pages.estates.estate-form', [
            'provinces' => $provinces,
            'cities'    => $cities,
        ]);
    }

    public function nextStep()
    {
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
