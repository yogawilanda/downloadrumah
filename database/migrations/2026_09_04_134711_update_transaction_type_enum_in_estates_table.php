<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE estates MODIFY COLUMN transaction_type ENUM('sale', 'rent', 'sale & rent') NOT NULL DEFAULT 'sale'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE estates MODIFY COLUMN transaction_type ENUM('sale', 'rent') NOT NULL DEFAULT 'sale'");
    }
};
