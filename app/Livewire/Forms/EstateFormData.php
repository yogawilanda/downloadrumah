<?php

namespace App\Livewire\Forms;

use App\Models\Estate;
use Livewire\Form;

class EstateFormData extends Form
{
    public ?Estate $estate = null;

    // Info Utama & Transaksi
    public string $title = '';
    public string $transaction_type = 'sale';
    public string $property_type = 'house';
    public $price = 0;
    public $commission_percentage = 0.0;
    public string $listing_group = '';
    public string $description = '';

    // Lokasi Detail (Foreign Keys)
    public ?string $province_id = null;
    public ?int $city_id = null;
    public string $district = '';
    public string $address = '';
    public string $block_number = '';
    public bool $show_map = true;

    // Detail Spesifikasi Utama
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

    // Agent Contact
    public string $agent_phone = '';

    // Dynamic JSON Attributes
    public array $attributes_list = [
        'is_kpr'            => false,
        'has_imb'           => false,
        'has_blueprint'     => false,
        'legal_docs'        => 'SHM',
        'promo_cooperation' => '',
        'agent_cooperation' => false,
        'electricity'       => '',
        'water_type'        => '',
        'nearest_places'    => [],
        'video_url'         => '',
    ];

    public function isEdit(): bool
    {
        return ! empty($this->estate?->id);
    }

    public function setEstate(Estate $estate): void
    {
        if (! $estate || ! $estate->exists) {
            $this->estate = null;
            return;
        }

        $this->estate = $estate;

        $this->title                 = $estate->title ?? '';
        $this->transaction_type      = $estate->transaction_type ?? 'sale';
        $this->property_type         = $estate->property_type ?? 'house';
        $this->price                 = $estate->price ?? 0;
        $this->commission_percentage = (float) ($estate->commission_percentage ?? 0);
        $this->listing_group         = $estate->listing_group ?? '';
        $this->description           = $estate->description ?? '';

        $this->province_id           = $estate->province_id ? (string) $estate->province_id : null;
        $this->city_id               = $estate->city_id ? (int) $estate->city_id : null;
        $this->district              = $estate->district ?? '';
        $this->address               = $estate->address ?? '';
        $this->block_number          = $estate->block_number ?? '';
        $this->show_map              = (bool) ($estate->show_map ?? true);

        $this->bedroom               = $estate->bedroom;
        $this->bathroom              = $estate->bathroom;
        $this->building_size         = $estate->building_size;
        $this->land_size             = $estate->land_size;
        $this->building_width        = $estate->building_width;
        $this->building_length       = $estate->building_length;
        $this->floor_count           = $estate->floor_count ?? 1;
        $this->garage_capacity       = $estate->garage_capacity;
        $this->facing                = $estate->facing ?? '';
        $this->furnish_type          = $estate->furnish_type ?? '';

        $this->agent_phone           = $estate->agent_phone ?? '';

        if (is_array($estate->attributes)) {
            $this->attributes_list   = array_merge($this->attributes_list, $estate->attributes);

            // Garansi casting ke string jika data di DB/Seeder terlanjur int
            if (isset($this->attributes_list['electricity']) && $this->attributes_list['electricity'] !== null) {
                $this->attributes_list['electricity'] = (string) $this->attributes_list['electricity'];
            }
        }
    }

    public function rules(): array
    {
        return [
            'title'                         => 'required|string|max:255',
            'transaction_type'              => 'required|in:sale,rent',
            'property_type'                 => 'required|string',
            'price'                         => 'required|numeric|min:0',
            'commission_percentage'         => 'nullable|numeric|between:0,100',
            'listing_group'                 => 'nullable|string|max:100',
            'description'                   => 'nullable|string',

            // Validasi wilayah
            'province_id'                   => 'nullable',
            'city_id'                       => 'nullable',

            'district'                      => 'nullable|string|max:100',
            'address'                       => 'nullable|string',
            'block_number'                  => 'nullable|string|max:50',
            'show_map'                      => 'boolean',

            'bedroom'                       => 'nullable|numeric|min:0',
            'bathroom'                      => 'nullable|numeric|min:0',
            'building_size'                 => 'nullable|numeric|min:0',
            'land_size'                     => 'nullable|numeric|min:0',
            'building_width'                => 'nullable|numeric|min:0',
            'building_length'               => 'nullable|numeric|min:0',
            'floor_count'                   => 'nullable|numeric|min:1',
            'garage_capacity'               => 'nullable|numeric|min:0',
            'facing'                        => 'nullable|string|max:50',
            'furnish_type'                  => 'nullable|string|max:50',

            'agent_phone'                   => 'nullable|string|max:30',

            'attributes_list.is_kpr'        => 'nullable|boolean',
            'attributes_list.has_imb'       => 'nullable|boolean',
            'attributes_list.has_blueprint' => 'nullable|boolean',
            'attributes_list.legal_docs'    => 'nullable|string|max:50',
            'attributes_list.electricity'   => 'nullable|string|max:50',
            'attributes_list.water_type'    => 'nullable|string|max:50',
            'attributes_list.video_url'     => 'nullable|string|max:500',
        ];
    }

    public function toSqlData(): array
    {
        $attributes = $this->attributes_list;

        // Casting boolean untuk checkbox
        foreach (['is_kpr', 'has_imb', 'has_blueprint', 'agent_cooperation'] as $key) {
            if (array_key_exists($key, $attributes)) {
                $attributes[$key] = filter_var($attributes[$key], FILTER_VALIDATE_BOOLEAN);
            }
        }

        // Pastikan electricity tersimpan sebagai string
        if (isset($attributes['electricity']) && $attributes['electricity'] !== '') {
            $attributes['electricity'] = (string) $attributes['electricity'];
        }

        return [
            'title'                 => trim($this->title),
            'transaction_type'      => $this->transaction_type,
            'property_type'         => $this->property_type,
            'price'                 => is_numeric($this->price) ? (float) $this->price : 0,
            'commission_percentage' => is_numeric($this->commission_percentage) && $this->commission_percentage > 0 ? (float) $this->commission_percentage : null,
            'listing_group'         => $this->listing_group ?: null,
            'description'           => $this->description ?: null,

            'province_id'           => $this->province_id ?: null,
            'city_id'               => $this->city_id ? (int) $this->city_id : null,
            'district'              => $this->district ?: null,
            'address'               => $this->address ?: null,
            'block_number'          => $this->block_number ?: null,
            'show_map'              => (bool) $this->show_map,

            'bedroom'               => is_numeric($this->bedroom) ? (int) $this->bedroom : null,
            'bathroom'              => is_numeric($this->bathroom) ? (int) $this->bathroom : null,
            'building_size'         => is_numeric($this->building_size) ? (int) $this->building_size : null,
            'land_size'             => is_numeric($this->land_size) ? (int) $this->land_size : null,
            'building_width'        => is_numeric($this->building_width) ? (float) $this->building_width : null,
            'building_length'       => is_numeric($this->building_length) ? (float) $this->building_length : null,
            'floor_count'           => is_numeric($this->floor_count) ? (int) $this->floor_count : 1,
            'garage_capacity'       => is_numeric($this->garage_capacity) ? (int) $this->garage_capacity : null,
            'facing'                => $this->facing ?: null,
            'furnish_type'          => $this->furnish_type ?: null,

            'agent_phone'           => $this->agent_phone ?: null,
            'attributes'            => $attributes,
        ];
    }
}
