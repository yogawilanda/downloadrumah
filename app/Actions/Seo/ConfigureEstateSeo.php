<?php

namespace App\Actions\Seo;

use App\Models\Estate;
use Illuminate\Support\Str;
use Laravel\Head\Enums\OgType;
use Laravel\Head\Facades\Head;
use Laravel\Head\Facades\Schema;

class ConfigureEstateSeo
{
    /**
     * Eksekusi konfigurasi SEO runtime untuk instance Estate.
     */
    public function __invoke(Estate $estate): void
    {
        $coverImage = $estate->primaryImage?->url
            ?? ($estate->attachments->first()?->file_path
                ? asset('storage/' . $estate->attachments->first()->file_path)
                : asset('favicon.png'));

        $location = $estate->short_location_label;
        $title = "{$estate->title} - {$estate->short_price}";
        $description = "Di{$estate->transaction_type_label} properti di {$location}. " . Str::limit(strip_tags($estate->description ?? ''), 120);

        Head::title($title)
            ->description($description)
            ->og(type: OgType::Article)
            ->ogImage($coverImage, width: 1200, height: 630)
            ->twitterImage($coverImage)
            ->schema(
                Schema::product()
                    ->name($estate->title)
                    ->description($description)
                    ->image($coverImage)
                    ->offers(
                        Schema::offer()
                            ->price($estate->price)
                            ->priceCurrency('IDR')
                    )
            );
    }
}
