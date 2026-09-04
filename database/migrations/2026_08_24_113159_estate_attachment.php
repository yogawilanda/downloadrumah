<?php

/**
 * <meta_config>
 * @path : database/migrations/2026_08_24_042558_create_estate_attachments_table.php | usage: Estates Public Media & Visual Attachments Schema
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * Step 4.1: Public Visual Attachments Table Mapping
         */
        Schema::create('estate_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estate_id')->constrained('estates')->cascadeOnDelete();

            $table->string('file_path');
            $table->enum('file_type', ['image', 'floorplan'])->default('image');
            $table->boolean('is_primary')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index('estate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /**
         * Step 4.2: Rollback Attachments Table
         */
        Schema::dropIfExists('estate_attachments');
    }
};
