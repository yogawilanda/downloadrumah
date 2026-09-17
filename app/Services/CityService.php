<?php

namespace App\Services;

use App\Models\City;
use App\Models\Estate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CityService
{
    /**
     * Resolve a city from user-provided location text.
     */
    public function findByName(string $name): ?City
    {
        $name = trim($name);

        if ($name === '') {
            return null;
        }

        $normalized = mb_strtolower($name);

        return City::query()
            ->select(['code', 'name', 'province_code'])
            ->whereRaw('LOWER(name) = ?', [$normalized])
            ->orWhereRaw('LOWER(name) = ?', ['kota ' . $normalized])
            ->orWhereRaw('LOWER(name) = ?', ['kabupaten ' . $normalized])
            ->first();
    }

    /**
     * Cache daftar kota dropdown
     */
    public function getDropdownCities(int $limit = 12): Collection
    {
        $rawArrays = Cache::remember("cities_dropdown_raw_{$limit}", now()->addDay(), function () use ($limit) {
            return City::query()
                ->select(['code', 'name', 'province_code'])
                ->orderBy('name')
                ->limit($limit)
                ->get()
                ->toArray();
        });

        // Hydrate array murni kembali jadi Collection Object City (aman dari __PHP_Incomplete_Class)
        return City::hydrate($rawArrays);
    }

    /**
     * Cache kota populer berdasarkan listing terbanyak
     */
    public function getPopularCities(int $limit = 5): Collection
    {
        $rawArrays = Cache::remember("cities_popular_raw_{$limit}", now()->addHours(6), function () use ($limit) {
            $topCityCodes = Estate::query()
                ->active()
                ->selectRaw('city_id, COUNT(*) as aggregate')
                ->groupBy('city_id')
                ->orderByDesc('aggregate')
                ->limit($limit)
                ->pluck('city_id');

            $query = City::query()->select(['code', 'name', 'province_code']);

            if ($topCityCodes->isNotEmpty()) {
                $query->whereIn('code', $topCityCodes);
            } else {
                $query->orderBy('name')->limit($limit);
            }

            return $query->get()->toArray();
        });

        return City::hydrate($rawArrays);
    }
}
