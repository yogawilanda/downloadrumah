<?php

/**
 * <meta_config>
 * @path : app/Livewire/Forms/Concerns/HasEstateFormMapper.php | usage: Form Data Transformation Trait for Estate
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : false | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Livewire\Forms\Concerns;

trait HasEstateFormMapper
{
    /**
     * Transformasi data form ke struktur kolom tabel SQL.
     */
    public function toSqlData(): array
    {
        $attributes = $this->attributes_list;

        foreach (['is_kpr', 'has_imb', 'has_blueprint', 'agent_cooperation'] as $key) {
            if (array_key_exists($key, $attributes)) {
                $attributes[$key] = filter_var($attributes[$key], FILTER_VALIDATE_BOOLEAN);
            }
        }

        if (isset($attributes['electricity']) && $attributes['electricity'] !== '') {
            $attributes['electricity'] = (string) $attributes['electricity'];
        }

        return [
            'title' => trim($this->title),
            'transaction_type' => $this->transaction_type,
            'property_type' => $this->property_type,
            'price' => is_numeric($this->price) ? (float) $this->price : 0,
            'commission_percentage' => is_numeric($this->commission_percentage) && $this->commission_percentage > 0 ? (float) $this->commission_percentage : null,
            'certificate_type' => $this->certificate_type ?: null,
            'listing_group' => $this->listing_group ?: null,
            'description' => $this->description ?: null,
            'province_id' => $this->province_id ?: null,
            'city_id' => $this->city_id ?: null,
            'district_id' => $this->district_id ?: null,
            'address' => $this->address ?: null,
            'block_number' => $this->block_number ?: null,
            'show_map' => (bool) $this->show_map,
            'bedroom' => is_numeric($this->bedroom) ? (int) $this->bedroom : null,
            'bathroom' => is_numeric($this->bathroom) ? (int) $this->bathroom : null,
            'building_size' => is_numeric($this->building_size) ? (int) $this->building_size : null,
            'land_size' => is_numeric($this->land_size) ? (int) $this->land_size : null,
            'building_width' => is_numeric($this->building_width) ? (float) $this->building_width : null,
            'building_length' => is_numeric($this->building_length) ? (float) $this->building_length : null,
            'floor_count' => is_numeric($this->floor_count) ? (int) $this->floor_count : 1,
            'garage_capacity' => is_numeric($this->garage_capacity) ? (int) $this->garage_capacity : null,
            'facing' => $this->facing ?: null,
            'furnish_type' => $this->furnish_type ?: null,
            'owner_name' => $this->owner_name ?: null,
            'owner_phone' => $this->owner_phone ?: null,
            'show_owner_phone' => (bool) $this->show_owner_phone,
            'attributes' => $attributes,
        ];
    }

    /**
     * Format data fasilitas terpilih agar siap di-sync ke pivot estate_facility.
     */
    public function toSyncFacilitiesData(): array
    {
        $formatted = [];
        foreach ($this->selected_facilities as $facilityId => $pivotData) {
            if (!empty($facilityId)) {
                $formatted[$facilityId] = [
                    'value' => is_array($pivotData) ? ($pivotData['value'] ?? null) : null,
                ];
            }
        }
        return $formatted;
    }
}
