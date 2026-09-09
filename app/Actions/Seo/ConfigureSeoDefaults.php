<?php

namespace App\Actions\Seo;

use App\DataObjects\SeoData;
use Laravel\Head\Enums\OgType;
use Laravel\Head\Enums\TwitterCard;
use Laravel\Head\Facades\Head;
use Laravel\Head\Facades\Schema;
use Laravel\Head\HeadBuilder;

class ConfigureSeoDefaults
{
    public function __construct(
        private SeoData $data = new SeoData()
    ) {}

    public function __invoke(): void
    {
        Head::defaults(function (HeadBuilder $head) {
            $manifestUrl = $this->data->assetUrl($this->data->manifestPath);
            $appleIconUrl = $this->data->assetUrl($this->data->appleTouchIconPath);
            $defaultOgImageUrl = $this->data->assetUrl($this->data->defaultOgImagePath);

            $head
                ->title($this->data->appName, suffix: $this->data->titleSuffix)
                ->description($this->data->description)
                ->canonical()
                ->og(siteName: $this->data->appName, type: OgType::Website, image: $defaultOgImageUrl)
                ->twitter(card: TwitterCard::SummaryWithLargeImage)
                ->twitterImage($defaultOgImageUrl)
                ->favicon($this->data->assetUrl($this->data->faviconPngPath), sizes: '96x96')
                ->icon($this->data->assetUrl($this->data->faviconSvgPath), type: 'image/svg+xml')
                ->appleTouchIcon($appleIconUrl, sizes: '180x180')
                ->manifest($manifestUrl)
                ->pwa(
                    name: $this->data->appName,
                    manifest: $manifestUrl,
                    themeColor: $this->data->themeColor,
                    appleTouchIcon: $appleIconUrl
                )
                ->schema(
                    Schema::webApplication()
                        ->name($this->data->appName)
                        ->url(config('app.url'))
                        ->applicationCategory($this->data->appCategory)
                        ->operatingSystem('All')
                        ->description($this->data->description)
                        ->author(
                            Schema::person()
                                ->name($this->data->authorName)
                                ->url($this->data->authorUrl)
                        )
                );
        });
    }
}
