<?php

/**
 * <meta_config>
 * @path : app/Providers/AppServiceProvider.php | usage: Application Bootstrapping & Global Safeguards
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Providers;

use App\Actions\Seo\ConfigureSeoDefaults;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
    public function boot(ConfigureSeoDefaults $configureSeoDefaults): void
    {
        $configureSeoDefaults();

        /**
         * Step 1.1: Storage Symlink Replacement Route
         * Fallback image delivery for restricted hosting environments.
         * Throttle is now admin-configurable via setting('throttle.storage').
         */
        Route::get('/storage/{path}', function ($path) {
            $filePath = storage_path('app/public/' . $path);

            if (!File::exists($filePath)) {
                abort(404);
            }

            $file = File::get($filePath);
            $type = File::mimeType($filePath);

            $response = Response::make($file, 200);
            $response->header('Content-Type', $type);

            return $response;
        })->where('path', '.*')->middleware('dynamic_throttle:throttle.storage,1');

        /**
         * Step 1.2: Database Migration Safeguard
         * Auto-dump MySQL before running destructive `migrate:fresh` command.
         */
        Event::listen(CommandStarting::class, function (CommandStarting $event) {
            if ($event->command === 'migrate:fresh' && !app()->environment('production')) {
                $this->autoBackupDatabase();
            }
        });
    }

    /**
     * Internal Database Backup Routine
     */
    private function autoBackupDatabase(): void
    {
        $connection = config('database.default');

        // Skip non-MySQL connections with a warning.
        if ($connection !== 'mysql') {
            echo "\n\033[33m[SAFEGUARD] Backup dilewati: connection '{$connection}' belum didukung.\033[0m\n\n";
            return;
        }

        $db = config("database.connections.{$connection}.database");
        $user = config("database.connections.{$connection}.username");
        $pass = config("database.connections.{$connection}.password");
        $host = config("database.connections.{$connection}.host");
        $port = config("database.connections.{$connection}.port");

        if (empty($db) || empty($user) || empty($host)) {
            echo "\n\033[31m[SAFEGUARD] Backup gagal: konfigurasi database tidak lengkap.\033[0m\n\n";
            return;
        }

        $backupDir = storage_path('app/backups');
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $fileName = 'backup_interceptor_migrate_fresh_' . date('Y-m-d_H-i-s') . '.sql';
        $filePath = $backupDir . '/' . $fileName;

        // Use MYSQL_PWD env var to avoid exposing the password in process listings.
        putenv("MYSQL_PWD={$pass}");
        $command = "mysqldump -h {$host} -P {$port} -u {$user} {$db} > \"{$filePath}\" 2>&1";

        exec($command, $output, $returnVar);
        putenv("MYSQL_PWD"); // Clear the password from the environment.

        if ($returnVar === 0 && File::exists($filePath) && File::size($filePath) > 0) {
            echo "\n\033[32m[SAFEGUARD] Database berhasil dibackup otomatis ke: storage/app/backups/{$fileName}\033[0m\n\n";
        } else {
            echo "\n\033[31m[SAFEGUARD] Backup GAGAL. Periksa konfigurasi mysqldump atau kredensial DB.\033[0m\n\n";
        }
    }
}
