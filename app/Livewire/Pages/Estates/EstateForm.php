<?php

/**
 * <meta_config>
 * @path : app/Livewire/Pages/Estates/EstateForm.php | usage: Main Orchestrator for Estate Wizard Form
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Livewire\Pages\Estates;

use App\Livewire\Forms\EstateFormData;
use App\Livewire\Pages\Estates\Concerns\HasEstateAttachmentManagement;
use App\Livewire\Pages\Estates\Concerns\HasFormWizardStep;
use App\Models\Estate;
use App\Models\Facility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
class EstateForm extends Component
{
    use HasEstateAttachmentManagement, HasFormWizardStep, WithFileUploads;

    public EstateFormData $form;

    /**
     * Mount component state for create/edit mode.
     */
    public function mount(?Estate $estate = null): void
    {
        if ($estate && $estate->exists) {
            if ($estate->user_id !== Auth::id())
                abort(403);

            $estate->load(['attachments', 'facilities']);
            $this->form->setEstate($estate);
            $this->existingPhotos = $estate->attachments->toArray();
        }
    }

    /**
     * Reset selected city when province changes.
     */
    public function updatedFormProvinceId(): void
    {
        $this->form->city_id = null;
        $this->form->district_id = null;
    }

    public function updatedFormCityId(): void
    {
        $this->form->district_id = null;
    }

    /**
     * Handle saving estate data, facilities sync, and attachments.
     */
    public function save()
    {
        $this->form->validate();
        $totalExisting = count($this->existingPhotos);

        if (!empty($this->photos)) {
            $this->validate([
                'photos' => ['array', 'max:' . max(0, 8 - $totalExisting)],
                'photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            ]);
        }

        if ($totalExisting === 0 && empty($this->photos)) {
            $this->addError('photos', 'Minimal unggah 1 foto listing.');
            return;
        }

        $data = $this->form->toSqlData();

        DB::transaction(function () use ($data) {
            if ($this->form->isEdit()) {
                $this->form->estate->update($data);
                $targetEstate = $this->form->estate;
            } else {
                $data['user_id'] = Auth::id();
                $data['slug'] = Str::slug($this->form->title) . '-' . Str::random(5);
                $data['status'] = 'active';

                $targetEstate = Estate::create($data);
            }

            $this->storeUploadedPhotos($targetEstate);
            $targetEstate->facilities()->sync($this->form->toSyncFacilitiesData());

            session()->flash('success', 'Data properti berhasil disimpan!');
        });

        // Pengalihan resmi standar Livewire 3 (mencegah bounceback & meriset state)
        return $this->redirectRoute('listings.index', navigate: true);
    }

    /**
     * Render Livewire view component.
     */
    public function render()
    {
        // Pastikan $cities diambil sesuai province_code
        $cities = $this->form->province_id
            ? City::where('province_code', $this->form->province_id)->orderBy('name')->get()
            : collect();

        // Jika city_id kamu menyimpan 'code' (char), query pakai city_code
        // Jika city_id menyimpan 'id' (integer), ambil model City dulu untuk dapat code-nya
        $districts = collect();
        if ($this->form->city_id) {
            $cityCode = is_numeric($this->form->city_id) && strlen((string) $this->form->city_id) < 4
                ? City::find($this->form->city_id)?->code
                : $this->form->city_id;

            $districts = $cityCode
                ? District::where('city_code', $cityCode)->orderBy('name')->get()
                : collect();
        }

        return view('livewire.pages.estates.estate-form', [
            'provinces' => Province::orderBy('name')->get(),
            'cities' => $cities,
            'districts' => $districts,
            'facilities' => Facility::orderBy('name')->get(),
        ]);
    }
}
