<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            // Pakai unsignedSmallInteger (2 Byte) range 0-65K
            $table->unsignedSmallInteger('id')->primary();

            $table->string('nama');

            // Presisi latitude/longitude (total 10-11 digit, 8 angka belakang koma)
            $table->decimal('latitude', 10, 8)->default(0)->nullable();
            $table->decimal('longitude', 11, 8)->default(0)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
