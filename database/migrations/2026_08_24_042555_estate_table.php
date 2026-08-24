<?php

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
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('transaction_type', ['sale', 'rent'])->default('sale');
            $table->decimal('price', 15, 2);

            // Lokasi Ringkas
            $table->string('city');
            $table->string('district')->nullable();
            $table->text('address')->nullable();

            // Spesifikasi Properti
            $table->unsignedSmallInteger('bedroom')->nullable();
            $table->unsignedSmallInteger('bathroom')->nullable();
            $table->unsignedInteger('building_size')->nullable()->comment('dalam m2');
            $table->unsignedInteger('land_size')->nullable()->comment('dalam m2');
            $table->text('description')->nullable();

            // jaga jaga ketika user mau minta informasi tambahan seperti hadap, sertifikatnya apa, dkk.
            $table->json('attributes')->nullable()->comment('Sertifikat, Promo, Listrik, Hadap, dll');

            // Status & Timestamps
            $table->enum('status', ['active', 'sold', 'rented', 'draft'])->default('active');
            $table->softDeletes();
            $table->timestamps();

            // Optimasi Indexing untuk Quick Search
            $table->index('title');
            $table->index('price');
            $table->index(['transaction_type', 'city', 'price']); // Composite Index
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};
