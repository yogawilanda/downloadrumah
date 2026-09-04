<?php

/**
 * <meta_config>
 * @path : database/migrations/2026_09_03_000001_create_activity_logs_table.php | usage: User Activity & Product Analytics Schema
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            /**
             * Step 1.1: Core Telemetry Payload
             * FE & BE Mapping:
             * - user_id      : Foreign Key ke users (NULL jika Guest, terisi ID jika Login) // user must be masked using uulid/uuid when public, and using user id for admin or certain criteria
             * - module       : Pengelompokan Fitur (contoh: 'traffic', 'estates', 'auth')
             * - event_name   : Akses/Aksi Spesifik (contoh: 'page_view', 'contact_agent_clicked')
             * - payload      : JSON dinamis untuk konteks (URL, filter, session_id, target ID)
             */
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('module', 50);
            $table->string('event_name', 100)->index();
            $table->json('payload')->nullable();

            /**
             * Step 1.2: Network & Environment Identity
             * Mapping:
             * - ip_address   : IP Visitor untuk analisis lokasi & deteksi spam
             * - user_agent   : Browser/Device metadata untuk analisa kompatibilitas UI
             */
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            /**
             * Step 1.3: Analytics Performance Indexing
             */
            $table->index(['module', 'event_name', 'created_at'], 'activity_logs_analytics_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /**
         * Step 1.4: Rollback Schema
         */
        Schema::dropIfExists('activity_logs');
    }
};
