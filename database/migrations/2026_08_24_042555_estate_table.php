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

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estates', function (Blueprint $table) {
            /**
             * Step 1.1: Core Identity & Pricing
             * FE Mapping:
             * - title & slug             : Draft Judul Listing & Auto URL
             * - transaction & property   : Select Option Tipe Transaksi & Properti
             * - price & commission       : Input Harga & Persentase Komisi Agent
             * - listing_group & desc     : Tagging Grup & Textarea Deskripsi
             */
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('transaction_type', ['sale', 'rent'])->default('sale');
            $table->enum('property_type', ['house', 'apartment', 'land', 'shophouse', 'villa', 'warehouse', 'office'])->default('house');
            $table->decimal('price', 15, 2)->unsigned();
            $table->decimal('commission_percentage', 5, 2)->unsigned()->nullable();
            $table->string('listing_group')->nullable();
            $table->text('description')->nullable();

            /**
             * Step 1.2: Regional Location Mapping
             * FE Mapping:
             * - province_id & city_id    : Dropdown Wilayah (Laravolt FK RESTRICT)
             * - district, address, block : Area Kecamatan, Alamat Jalan, Blok/Nomor
             * - show_map                 : Toggle Switch Tampilkan Peta Posisional
             */
            $table->string('province_id', 2)->nullable();
            $table->foreign('province_id')->references('code')->on('indonesia_provinces')->onDelete('restrict');
            $table->foreignId('city_id')->nullable()->constrained('indonesia_cities')->onDelete('restrict');
            $table->string('district')->nullable();
            $table->text('address')->nullable();
            $table->string('block_number')->nullable();
            $table->boolean('show_map')->default(true);

            /**
             * Step 1.3: Specifications & Physical Features
             * FE Mapping:
             * - bedroom & bathroom       : Input Counter/Number Kamar
             * - building & land sizes    : Input Luas (m2) & Dimensi Lebar/Panjang
             * - floor & garage           : Counter Jumlah Lantai & Kapasitas Mobil
             * - facing & furnish_type    : Select Arah Hadap & Tipe Furnish
             * - agent_phone              : Nomor Telepon Agen Penanggung Jawab
             */
            $table->unsignedSmallInteger('bedroom')->nullable();
            $table->unsignedSmallInteger('bathroom')->nullable();
            $table->unsignedInteger('building_size')->nullable();
            $table->unsignedInteger('land_size')->nullable();
            $table->unsignedDecimal('building_width', 8, 2)->nullable();
            $table->unsignedDecimal('building_length', 8, 2)->nullable();
            $table->unsignedSmallInteger('floor_count')->nullable()->default(1);
            $table->unsignedSmallInteger('garage_capacity')->nullable();
            $table->enum('facing', ['north', 'south', 'east', 'west', 'north_east', 'north_west', 'south_east', 'south_west'])->nullable();
            $table->enum('furnish_type', ['unfurnished', 'semi_furnished', 'full_furnished'])->nullable();
            $table->string('agent_phone', 20)->nullable();

            /**
             * Step 1.4: Dynamic Attributes, Status, & Indexing
             * FE Mapping:
             * - attributes (JSON)        : Dynamic Checkbox (KPR, IMB, Blueprint, Legal Docs) & Media (Video URL)
             * - status                   : Status Workflow Listing (Draft -> Active -> Sold/Rented)
             */
            $table->json('attributes')->nullable()->comment('Menampung: KPR, IMB, Blueprint, Legal Docs, Promosi, Utilities, Nearest Places, Video URL');
            $table->enum('status', ['active', 'sold', 'rented', 'draft'])->default('draft');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'transaction_type', 'property_type', 'city_id', 'price'], 'estates_quick_search_idx');
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
