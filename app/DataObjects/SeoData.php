<?php

namespace App\DataObjects;

readonly class SeoData
{
    public function __construct(
        public string $appName = 'Download Rumah',
        public string $titleSuffix = ' | Platform Properti & Kalkulasi KPR',
        public string $description = 'Temukan hunian impian, kalkulasi KPR presisi, dan konsultasi properti cepat & transparan di Download Rumah.',
        public string $themeColor = '#2563eb',
        public string $appCategory = 'BusinessApplication',
        public string $authorName = 'Yoga Wilanda',
        public string $authorUrl = 'https://yogawilanda.com',

        // Asset Versioning for Cache Busting
        public string $assetVersion = '20260905',

        public string $manifestPath = 'favicon/site.webmanifest',
        public string $faviconPngPath = 'favicon/favicon-96x96.png',
        public string $faviconSvgPath = 'favicon/favicon.svg',
        public string $appleTouchIconPath = 'favicon/apple-touch-icon.png',
        public string $defaultOgImagePath = 'favicon.png',
    ) {}

    /**
     * Helper method untuk menghasilkan URL asset dengan query string versi
     */
    public function assetUrl(string $path): string
    {
        return asset($path) . '?v=' . $this->assetVersion;
    }
}
