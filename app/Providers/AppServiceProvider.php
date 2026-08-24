<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Route pengganti symlink storage
        Route::get('/storage/{path}', function ($path) {
            $filePath = storage_path('app/public/' . $path);

            if (!File::exists($filePath)) {
                abort(404);
            }

            $file = File::get($filePath);
            $type = File::mimeType($filePath);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $response;
        })->where('path', '.*');
    }
}
