<?php

/**
 * <meta_config>
 * @path : database/migrations/2026_09_06_101000_add_is_super_admin_to_users_table.php
 * @usage : Add is_super_admin flag to gate admin surface
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * @author : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_super_admin')->default(false)->after('phone_number');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_super_admin');
        });
    }
};
