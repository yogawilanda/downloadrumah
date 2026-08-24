<?php

namespace App\Livewire\Pages\Estates;

use App\Models\Estate;
use App\Models\EstateAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class EstateForm extends Component
{
    use WithFileUploads;

    public ?Estate $estate = null;
    public bool $isEdit = false;

    public string $title = '';
    public string $transaction_type = 'sale';
    public $price;
    public string $city = '';
    public string $district = '';
    public string $address = '';
    public $bedroom;
    public $bathroom;
    public $building_size;
    public $land_size;
    public string $description = '';

    public array $attributes_list = [
        'garage' => false,
        'swimming_pool' => false,
        'garden' => false,
        'pam' => false,
        'certificate' => 'SHM',
    ];

    public array $existingPhotos = [];
    public array $photos = [];

    public function mount(?Estate $estate = null): void
    {
        if ($estate && $estate->exists) {
            // Cek otorisasi edit
            if ($estate->user_id !== Auth::id()) {
                abort(403);
            }

            $this->estate = $estate;
            $this->isEdit = true;

            $this->title = $estate->title;
            $this->transaction_type = $estate->transaction_type;
            $this->price = $estate->price;
            $this->city = $estate->city;
            $this->district = $estate->district;
            $this->address = $estate->address ?? '';
            $this->bedroom = $estate->bedroom;
            $this->bathroom = $estate->bathroom;
            $this->building_size = $estate->building_size;
            $this->land_size = $estate->land_size;
            $this->description = $estate->description;
            $this->attributes_list = array_merge($this->attributes_list, $estate->attributes ?? []);

            $this->existingPhotos = $estate->attachments->toArray();
        }
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'transaction_type' => 'required|in:sale,rent',
            'price' => 'required|numeric|min:0',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'address' => 'nullable|string',
            'bedroom' => 'nullable|integer|min:0',
            'bathroom' => 'nullable|integer|min:0',
            'building_size' => 'nullable|integer|min:0',
            'land_size' => 'nullable|integer|min:0',
            'description' => 'required|string',
            'photos.*' => 'image|max:3072',
        ];
    }

    public function removePhoto(int $index): void
    {
        array_splice($this->photos, $index, 1);
    }

    public function deleteExistingPhoto(int $attachmentId): void
    {
        $attachment = EstateAttachment::find($attachmentId);
        if ($attachment && $attachment->estate_id === $this->estate->id) {
            Storage::disk('public')->delete($attachment->file_path);
            $attachment->delete();

            $this->existingPhotos = array_filter(
                $this->existingPhotos,
                fn($photo) => $photo['id'] !== $attachmentId
            );
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'transaction_type' => $this->transaction_type,
            'price' => $this->price,
            'city' => $this->city,
            'district' => $this->district,
            'address' => $this->address,
            'bedroom' => $this->bedroom ?: 0,
            'bathroom' => $this->bathroom ?: 0,
            'building_size' => $this->building_size ?: 0,
            'land_size' => $this->land_size ?: 0,
            'description' => $this->description,
            'attributes' => $this->attributes_list,
        ];

        if ($this->isEdit) {
            $this->estate->update($data);
            $targetEstate = $this->estate;
            $message = 'Properti berhasil diperbarui!';
        } else {
            $data['user_id'] = Auth::id();
            $data['slug'] = Str::slug($this->title) . '-' . Str::random(5);
            $data['status'] = 'active';

            $targetEstate = Estate::create($data);
            $message = 'Properti berhasil diterbitkan!';
        }

        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                $path = $photo->store('estates', 'public');

                EstateAttachment::create([
                    'estate_id' => $targetEstate->id,
                    'file_path' => $path,
                ]);
            }
        }

        session()->flash('success', $message);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.pages.estates.estate-form');
    }
}
