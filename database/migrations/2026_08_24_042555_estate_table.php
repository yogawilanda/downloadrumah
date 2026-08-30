<?php
// loc      : database/migrations/2026_08_24_042555_create_estates_table.php
// usage    : Create estates table fully mapped with agent listing form fields
// status   : Production Ready
// note     : Updated schema with line-by-line Form/UI mapping comments

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Info Utama
            $table->string('title'); // FE: Draft Judul Listing
            $table->string('slug')->unique(); // System: URL Slug (Generated from Title)
            $table->enum('transaction_type', ['sale', 'rent'])->default('sale'); // FE: Tipe Transaksi
            $table->enum('property_type', ['house', 'apartment', 'land', 'shophouse', 'villa', 'warehouse', 'office'])->default('house'); // FE: Tipe Properti
            $table->decimal('price', 15, 2); // FE: Harga Jual
            $table->decimal('commission_percentage', 5, 2)->nullable(); // FE: Presentase Komisi
            $table->string('listing_group')->nullable(); // FE: Grup Listing
            $table->text('description')->nullable(); // FE: Draft Deskripsi

            // Lokasi Listing
            $table->string('province')->nullable(); // FE: Provinsi
            $table->string('city'); // FE: Kota
            $table->string('district')->nullable(); // FE: Area
            $table->text('address')->nullable(); // FE: Alamat (Tanpa Blok & Nomor)
            $table->string('block_number')->nullable(); // FE: Blok dan Nomor
            $table->boolean('show_map')->default(true); // FE: Tampilkan peta?

            // Detail Listing
            $table->unsignedSmallInteger('bedroom')->nullable(); // FE: Kamar Tidur
            $table->unsignedSmallInteger('bathroom')->nullable(); // FE: Kamar Mandi
            $table->unsignedInteger('building_size')->nullable(); // FE: Luas Bangunan (m2)
            $table->unsignedInteger('land_size')->nullable(); // FE: Luas Tanah (m2)
            $table->decimal('building_width', 8, 2)->nullable(); // FE: Lebar Properti
            $table->decimal('building_length', 8, 2)->nullable(); // FE: Panjang Properti
            $table->unsignedSmallInteger('floor_count')->nullable()->default(1); // FE: Jumlah Lantai
            $table->unsignedSmallInteger('garage_capacity')->nullable(); // FE: Kapasitas garasi
            $table->enum('facing', ['north', 'south', 'east', 'west', 'north_east', 'north_west', 'south_east', 'south_west'])->nullable(); // FE: Hadap
            $table->enum('furnish_type', ['unfurnished', 'semi_furnished', 'full_furnished'])->nullable(); // FE: Tipe Furnish

            // Agent / Vendor Contact
            $table->string('agent_phone', 20)->nullable(); // FE: Nama Vendor/Pemilik (Diganti dengan Nomor Agen properti yang menjual)

            // Informasi Tambahan & Legalitas Dinamis (JSON)
            // FE Handling:
            // - attributes->is_kpr             : Bisa KPR? (Boolean)
            // - attributes->has_imb            : IMB (Boolean)
            // - attributes->has_blueprint      : Ada BluePrint? (Boolean)
            // - attributes->legal_docs         : Dokumen legal (SHM, HGB, dll)
            // - attributes->promo_cooperation  : Promosi Kerja Sama
            // - attributes->agent_cooperation  : Kerjasama dengan agent lain?
            // - attributes->electricity        : Tegangan Listrik
            // - attributes->water_type         : Tipe Air
            // - attributes->nearest_places     : Tempat Terdekat / Tempat terdekat
            // - attributes->video_url          : Link Tautan Video Properti
            $table->json('attributes')->nullable()->comment('Menampung: KPR, IMB, Blueprint, Legal Docs, Promosi, Utilities, Nearest Places, Video URL');

            // Status & Timestamps
            $table->enum('status', ['active', 'sold', 'rented', 'draft'])->default('draft'); // FE Workflow: Konfirmasi Listing -> Submit
            $table->softDeletes();
            $table->timestamps();

            // Optimasi Indexing Quick Search Engine
            $table->index('title');
            $table->index('price');
            $table->index(['status', 'transaction_type', 'property_type', 'city', 'price'], 'estates_quick_search_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};
