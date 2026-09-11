<?php

namespace App\Actions\Seo;

use App\Models\Estate;
use App\Models\User;
use Laravel\Head\Enums\OgType;
use Laravel\Head\Facades\Head;
use Laravel\Head\Facades\Schema;

class ConfigureAgentCatalogEstateSeo
{
    public function __invoke(User $agent, Estate $estate): void
    {
        $title = "{$estate->title} | {$agent->display_brand_name}";
        $description = "{$estate->transaction_type_label} {$estate->title} seharga {$estate->short_price} di {$estate->short_location_label}. Hubungi {$agent->display_brand_name} via katalog resmi.";
        $ogImage = $estate->primaryImage?->url ?? asset('images/default-estate-og.jpg');

        Head::title($title, exact: true)
            ->description($description)
            ->og(
                type: OgType::Article,
                title: $title,
                description: $description,
                image: $ogImage
            )
            ->twitterImage($ogImage)
            ->schema(
                Schema::product()
                    ->name($estate->title)
                    ->description($description)
                    ->image($ogImage)
            );
    }
}
