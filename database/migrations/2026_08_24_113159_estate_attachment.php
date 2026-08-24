<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estate_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estate_id')->constrained('estates')->cascadeOnDelete();

            $table->string('file_path');
            $table->enum('file_type', ['image', 'document', 'floorplan'])->default('image');
            $table->boolean('is_primary')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index('estate_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estate_attachments');
    }
};
