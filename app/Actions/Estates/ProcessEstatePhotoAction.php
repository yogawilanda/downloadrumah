<?php

namespace App\Actions\Estates;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Alignment;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class ProcessEstatePhotoAction
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function execute(UploadedFile $file, bool $withWatermark = false): string
    {
        $filename = Str::uuid() . '.webp';
        $relativePath = 'estates/' . $filename;
        $fullPath = storage_path('app/public/' . $relativePath);

        if (!file_exists(storage_path('app/public/estates'))) {
            mkdir(storage_path('app/public/estates'), 0755, true);
        }

        $image = $this->manager->decode($file);
        $image->scaleDown(width: 1920, height: 1920);

        if ($withWatermark) {
            $pngWatermark = public_path('watermark.png');
            $ttfFont = public_path('fonts/Outfit-Bold.ttf');
            $alignment = Alignment::CENTER;

            if (file_exists($pngWatermark)) {
                $watermark = $this->manager->decode($pngWatermark);
                // Set ukuran watermark jadi 40% dari lebar gambar utama
                $targetWidth = (int) ($image->width() * 0.50);
                $watermark->scaleDown(width: $targetWidth);

                /**
                 * function ImageInterface::insert(
                 * mixed $image
                 * @param mixed $decode = ambil path file yang dibutuhkan
                 * @param int $int = $var x
                 * @param int $int = $var y
                 * @param Alignment $name
                 * @param float $name
                 */
                $image->insert($watermark, 0, 0, $alignment, 0.3);
            } else {
                $x = $image->width() - 30;
                $y = $image->height() - 30;

                $image->text('Download Rumah', $x, $y, function ($font) use ($ttfFont) {
                    if (file_exists($ttfFont)) {
                        $font->filename($ttfFont);
                        $font->size(32);
                    } else {
                        $font->size(28);
                    }
                    $font->color('ffffff');
                    $font->align('right');
                    $font->valign('bottom');
                });
            }
        }

        $encoded = $image->encodeUsingFormat(Format::WEBP, 80);
        $encoded->save($fullPath);

        return $relativePath;
    }
}
