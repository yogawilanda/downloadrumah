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
    public function boot(): void
    {
        /**
         * Step 1.1: Storage Symlink Replacement Route
         * Fallback image delivery for restricted hosting environments.
         */
        Route::get('/storage/{path}', function ($path) {
            $filePath = storage_path('app/public/' . $path);

            if (! File::exists($filePath)) {
                abort(404);
            }

            $file = File::get($filePath);
            $type = File::mimeType($filePath);

            $response = Response::make($file, 200);
            $response->header('Content-Type', $type);

            return $response;
        })->where('path', '.*');

        /**
         * Step 1.2: Database Migration Safeguard
         * Auto-dump MySQL before running destructive `migrate:fresh` command.
         */
        Event::listen(CommandStarting::class, function (CommandStarting $event) {
            if ($event->command === 'migrate:fresh') {
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
        $db = config("database.connections.{$connection}.database");
        $user = config("database.connections.{$connection}.username");
        $pass = config("database.connections.{$connection}.password");
        $host = config("database.connections.{$connection}.host");
        $port = config("database.connections.{$connection}.port");

        $backupDir = storage_path('app/backups');
        if (! File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $fileName = 'backup_interceptor_migrate_fresh_' . date('Y-m-d_H-i-s') . '.sql';
        $filePath = $backupDir . '/' . $fileName;

        $passParam = $pass ? "-p'{$pass}'" : '';
        $command = "mysqldump -h {$host} -P {$port} -u {$user} {$passParam} {$db} > \"{$filePath}\" 2>&1";

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            echo "\n\033[32m[SAFEGUARD] Database berhasil dibackup otomatis ke: storage/app/backups/{$fileName}\033[0m\n\n";
        }
    }
}
