<?php

/**
 * <meta_config>
 * @path : database/migrations/2026_08_24_042556_create_facilities_and_estate_facility_table.php | usage: Estates Facility Master & Pivot Schema
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
         * Step 2.1: Master Facilities Table
         */
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('general');
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        /**
         * Step 2.2: Estate & Facility Pivot Table
         */
        Schema::create('estate_facility', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estate_id')->constrained()->cascadeOnDelete();
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->timestamps();

            $table->unique(['estate_id', 'facility_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /**
         * Step 2.3: Rollback Tables
         */
        Schema::dropIfExists('estate_facility');
        Schema::dropIfExists('facilities');
    }
};
