<?php

/**
 * <meta_config>
 * @path : app/Livewire/Forms/EstateFormData.php | usage: Form Object for Estate Creation & Modification
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : false | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Livewire\Forms;

use App\Livewire\Forms\Concerns\HasEstateFormMapper;
use App\Models\Estate;
use Livewire\Form;

class EstateFormData extends Form
{
    use HasEstateFormMapper;

    public ?Estate $estate = null;

    // Info Utama & Transaksi
    public string $title = '';
    public string $transaction_type = 'sale';
    public string $property_type = 'house';
    public $price = 0;
    public $commission_percentage = 0.0;
    public string $certificate_type = 'shm';
    public string $listing_group = '';
    public string $description = '';

    // Lokasi Detail
    public ?string $province_id = null;
    public ?string $city_id = null;
    public ?string $district_id = null;
    public string $district = '';
    public string $address = '';
    public string $block_number = '';
    public bool $show_map = true;

    // Spesifikasi Fisik
    public $bedroom;
    public $bathroom;
    public $building_size;
    public $land_size;
    public $building_width;
    public $building_length;
    public $floor_count = 1;
    public $garage_capacity;
    public string $facing = '';
    public string $furnish_type = '';

    // Contact & Pivot State
    public bool $show_owner_phone = false;
    public string $owner_name = '';
    public string $owner_phone = '';
    public array $selected_facilities = [];

    // JSON Attributes
    public array $attributes_list = [
        'is_kpr' => false,
        'has_imb' => false,
        'has_blueprint' => false,
        'legal_docs' => 'SHM',
        'promo_cooperation' => '',
        'agent_cooperation' => false,
        'electricity' => '',
        'water_type' => '',
        'nearest_places' => [],
        'video_url' => '',
    ];

    public function isEdit(): bool
    {
        return !empty($this->estate?->id);
    }

    public function setEstate(Estate $estate): void
    {
        if (!$estate || !$estate->exists) {
            $this->estate = null;
            return;
        }

        $this->estate = $estate;
        $this->title = $estate->title ?? '';
        $this->transaction_type = $estate->transaction_type ?? 'sale';
        $this->property_type = $estate->property_type ?? 'house';
        $this->price = $estate->price ?? 0;
        $this->commission_percentage = (float) ($estate->commission_percentage ?? 0);
        $this->certificate_type = $estate->certificate_type ?? 'shm';
        $this->listing_group = $estate->listing_group ?? '';
        $this->description = $estate->description ?? '';

        $this->province_id = $estate->province_id ? (string) $estate->province_id : null;
        $this->city_id = $estate->city_id ? (string) $estate->city_id : null;
        $this->district_id = $estate->district_id ? (string) $estate->district_id : null;
        $this->district = $estate->district ?? '';
        $this->address = $estate->address ?? '';
        $this->block_number = $estate->block_number ?? '';
        $this->show_map = (bool) ($estate->show_map ?? true);

        $this->bedroom = $estate->bedroom;
        $this->bathroom = $estate->bathroom;
        $this->building_size = $estate->building_size;
        $this->land_size = $estate->land_size;
        $this->building_width = $estate->building_width;
        $this->building_length = $estate->building_length;
        $this->floor_count = $estate->floor_count ?? 1;
        $this->garage_capacity = $estate->garage_capacity;
        $this->facing = $estate->facing ?? '';
        $this->furnish_type = $estate->furnish_type ?? '';
        $this->show_owner_phone = (bool) ($estate->show_owner_phone ?? false);
        $this->owner_name = $estate->owner_name ?? '';
        $this->owner_phone = $estate->owner_phone ?? '';

        if (is_array($estate->attributes)) {
            $this->attributes_list = array_merge($this->attributes_list, $estate->attributes);
        }

        $this->selected_facilities = [];
        if ($estate->exists) {
            foreach ($estate->facilities as $facility) {
                $this->selected_facilities[$facility->id] = [
                    'id' => $facility->id,
                    'value' => $facility->pivot->value ?? null,
                ];
            }
        }
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'transaction_type' => 'required|in:sale,rent,sale & rent',
            'property_type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'commission_percentage' => 'nullable|numeric|between:0,100',
            'certificate_type' => 'nullable|in:shm,hgb,hp,girik,ppjb,strata_title,other',
            'listing_group' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'province_id' => 'nullable|string',
            'city_id' => 'nullable|string',
            'district_id' => 'nullable|string',
            'address' => 'nullable|string',
            'block_number' => 'nullable|string|max:50',
            'show_map' => 'boolean',
            'bedroom' => 'nullable|numeric|min:0',
            'bathroom' => 'nullable|numeric|min:0',
            'building_size' => 'nullable|numeric|min:0',
            'land_size' => 'nullable|numeric|min:0',
            'building_width' => 'nullable|numeric|min:0',
            'building_length' => 'nullable|numeric|min:0',
            'floor_count' => 'nullable|numeric|min:1',
            'garage_capacity' => 'nullable|numeric|min:0',
            'facing' => 'nullable|string|max:50',
            'furnish_type' => 'nullable|string|max:50',
            'show_owner_phone' => 'boolean',
            'owner_name' => 'nullable|string|max:60',
            'owner_phone' => 'nullable|string|max:30',
            'attributes_list.is_kpr' => 'nullable|boolean',
            'attributes_list.has_imb' => 'nullable|boolean',
            'attributes_list.has_blueprint' => 'nullable|boolean',
            'attributes_list.legal_docs' => 'nullable|string|max:50',
            'attributes_list.electricity' => 'nullable|string|max:50',
            'attributes_list.water_type' => 'nullable|string|max:50',
            'attributes_list.video_url' => 'nullable|string|max:500',
        ];
    }
}
