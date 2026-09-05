<?php

/**
 * <meta_config>
 * @path : database/migrations/2026_08_24_042555_create_estates_table.php | usage: Estates Core Listing Schema
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
        Schema::create('estates', function (Blueprint $table) {
            /**
             * Step 1.1: Core Identity, Legal & Pricing
             */
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('transaction_type', ['sale', 'rent', 'sale & rent'])->default('sale');
            $table->unsignedBigInteger('price');
            $table->boolean('is_kpr')->default(true);
            $table->enum('certificate_type', ['shm', 'hgb', 'hp', 'girik', 'ppjb', 'strata_title', 'other'])->nullable();
            $table->enum('property_type', ['house', 'apartment', 'land', 'shophouse', 'villa', 'warehouse', 'office'])->default('house');
            $table->decimal('commission_percentage', 5, 2)->nullable();
            $table->enum('listing_group', ['primary', 'secondary'])->nullable();
            $table->text('description')->nullable();

            /**
             * Step 1.2: Regional Location Mapping (Standardized Laravolt Codes)
             */
            $table->string('country')->default('Indonesia');

            // Provinsi (Char 2)
            $table->char('province_id', 2)->nullable();
            $table->foreign('province_id')->references('code')->on('indonesia_provinces')->onDelete('restrict');

            // Kota / Kabupaten (Char 4)
            $table->char('city_id', 4)->nullable();
            $table->foreign('city_id')->references('code')->on('indonesia_cities')->onDelete('restrict');

            // Kecamatan (Char 7)
            $table->char('district_id', 7)->nullable();
            $table->foreign('district_id')->references('code')->on('indonesia_districts')->onDelete('restrict');

            $table->text('address')->nullable();
            $table->string('block_number')->nullable();
            $table->string('map_url')->nullable();
            $table->boolean('show_map')->default(true);

            /**
             * Step 1.3: Specifications & Physical Features
             */
            $table->unsignedSmallInteger('bedroom')->nullable();
            $table->unsignedSmallInteger('bathroom')->nullable();
            $table->unsignedInteger('building_size')->nullable();
            $table->unsignedInteger('land_size')->nullable();
            $table->decimal('building_width', 8, 2)->nullable();
            $table->decimal('building_length', 8, 2)->nullable();
            $table->unsignedSmallInteger('floor_count')->nullable()->default(1);
            $table->unsignedSmallInteger('garage_capacity')->nullable();
            $table->enum('facing', ['north', 'south', 'east', 'west', 'north_east', 'north_west', 'south_east', 'south_west'])->nullable();
            $table->enum('furnish_type', ['unfurnished', 'semi_furnished', 'full_furnished'])->nullable();

            /**
             * Step 1.4: Owner Contacts & Status Workflow
             */
            $table->string('owner_name')->nullable();
            $table->string('owner_phone', 20)->nullable();
            $table->boolean('show_owner_phone')->default(false);
            $table->enum('status', ['active', 'sold', 'rented', 'draft'])->default('draft');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'transaction_type', 'property_type', 'city_id', 'price', 'is_kpr'], 'estates_quick_search_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /**
         * Step 1.5: Rollback Schema
         */
        Schema::dropIfExists('estates');
    }
};
