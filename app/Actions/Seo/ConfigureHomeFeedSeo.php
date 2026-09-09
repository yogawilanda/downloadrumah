<?php

namespace App\Actions\Seo;

use Laravel\Head\Enums\OgType;
use Laravel\Head\Facades\Head;

class ConfigureHomeFeedSeo
{
    /**
     * Terapkan metadata dinamis untuk Home Feed berdasarkan parameter pencarian aktif.
     */
    public function __invoke(?string $search = null, ?string $city = null, mixed $maxPrice = null): void
    {
        $searchPrefix = $search ? "{$search} - " : '';
        $cityPrefix = $city ? "Properti di {$city} - " : '';
        $title = "{$searchPrefix}{$cityPrefix}Download Rumah";

        $formattedPrice = $maxPrice ? ' hingga Rp' . number_format((float) $maxPrice, 0, ',', '.') : '';
        $cityContext = $city ? "di {$city}" : '';
        $description = "Cari properti {$cityContext}{$formattedPrice} di Download Rumah.";

        Head::title($title, exact: true)
            ->description($description)
            ->og(
                type: OgType::Website,
                title: $title,
                description: $description,
                image: asset('favicon.png') . '?v=20260905'
            );
    }
}
