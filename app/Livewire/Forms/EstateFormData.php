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
    public int $price = 0;
    public float $commission_percentage = 0.0;
    public string $listing_group = '';
    public string $description = '';

    // Lokasi Detail
    public string $province = '';
    public string $city = '';
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

    /**
     * Cek status edit secara aman berdasarkan ID estate di database.
     */
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

        $this->title                 = $estate->title;
        $this->transaction_type      = $estate->transaction_type;
        $this->property_type         = $estate->property_type ?? 'house';
        $this->price                 = $estate->price ?? 0;
        $this->commission_percentage = (float) ($estate->commission_percentage ?? 0);
        $this->listing_group         = $estate->listing_group ?? '';
        $this->description           = $estate->description ?? '';

        $this->province              = $estate->province ?? '';
        $this->city                  = $estate->city;
        $this->district              = $estate->district ?? '';
        $this->address               = $estate->address ?? '';
        $this->block_number          = $estate->block_number ?? '';
        $this->show_map              = (bool) $estate->show_map;

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
        $this->attributes_list       = array_merge($this->attributes_list, $estate->attributes ?? []);
    }

    public function rules(): array
    {
        return [
            'title'                         => 'required|string|max:255',
            'transaction_type'              => 'required|in:sale,rent',
            'property_type'                 => 'required|in:house,apartment,land,shophouse,villa,warehouse,office',
            'price'                         => 'required|numeric|min:0',
            'commission_percentage'         => 'nullable|numeric|between:0,100',
            'listing_group'                 => 'nullable|string|max:100',
            'description'                   => 'nullable|string',

            'province'                      => 'nullable|string|max:100',
            'city'                          => 'required|string|max:100',
            'district'                      => 'nullable|string|max:100',
            'address'                       => 'nullable|string',
            'block_number'                  => 'nullable|string|max:50',
            'show_map'                      => 'boolean',

            'bedroom'                       => 'nullable|integer|min:0',
            'bathroom'                      => 'nullable|integer|min:0',
            'building_size'                 => 'nullable|integer|min:0',
            'land_size'                     => 'nullable|integer|min:0',
            'building_width'                => 'nullable|numeric|min:0',
            'building_length'               => 'nullable|numeric|min:0',
            'floor_count'                   => 'nullable|integer|min:1',
            'garage_capacity'               => 'nullable|integer|min:0',
            'facing'                        => 'nullable|in:north,south,east,west,north_east,north_west,south_east,south_west',
            'furnish_type'                  => 'nullable|in:unfurnished,semi_furnished,full_furnished',

            'agent_phone'                   => 'nullable|string|max:20',

            // Validasi bertingkat untuk JSON Attributes
            'attributes_list.is_kpr'        => 'boolean',
            'attributes_list.has_imb'       => 'boolean',
            'attributes_list.has_blueprint' => 'boolean',
            'attributes_list.legal_docs'    => 'nullable|string|max:50',
            'attributes_list.electricity'   => 'nullable|string|max:50',
            'attributes_list.water_type'    => 'nullable|string|max:50',
            'attributes_list.video_url'     => 'nullable|url|max:255',
        ];
    }

    public function toSqlData(): array
    {
        $attributes = $this->attributes_list;

        foreach (['is_kpr', 'has_imb', 'has_blueprint', 'agent_cooperation'] as $key) {
            if (array_key_exists($key, $attributes)) {
                $attributes[$key] = filter_var($attributes[$key], FILTER_VALIDATE_BOOLEAN);
            }
        }

        return [
            'title'                 => trim($this->title),
            'transaction_type'      => $this->transaction_type,
            'property_type'         => $this->property_type,
            'price'                 => $this->price,
            'commission_percentage' => is_numeric($this->commission_percentage) && $this->commission_percentage > 0 ? (float) $this->commission_percentage : null,
            'listing_group'         => $this->listing_group ?: null,
            'description'           => $this->description ?: null,

            'province'              => $this->province ?: null,
            'city'                  => trim($this->city),
            'district'              => $this->district ?: null,
            'address'               => $this->address ?: null,
            'block_number'          => $this->block_number ?: null,
            'show_map'              => $this->show_map,

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
