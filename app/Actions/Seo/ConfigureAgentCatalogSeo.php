<?php

namespace App\Actions\Seo;

use App\Models\User;
use Laravel\Head\Enums\OgType;
use Laravel\Head\Facades\Head;
use Laravel\Head\Facades\Schema;

class ConfigureAgentCatalogSeo
{
    /**
     * Eksekusi konfigurasi SEO runtime untuk etalase publik agen.
     */
    public function __invoke(User $agent): void
    {
        $brandName = $agent->display_brand_name;
        $title = "Katalog Properti {$brandName}";
        $description = "Cari dan temukan daftar properti dijual & disewa resmi langsung dari etalase " . $brandName . ".";
        $avatarImage = $agent->profile_photo_url ?? asset('favicon.png');

        Head::title($title, exact: true)
            ->description($description)
            ->og(
                type: OgType::Profile,
                title: $title,
                description: $description,
                image: $avatarImage
            )
            ->twitterImage($avatarImage)
            ->schema(
                Schema::person()
                    ->name($brandName)
                    ->jobTitle('Agent Properti')
                    ->image($avatarImage)
            );
    }
}
