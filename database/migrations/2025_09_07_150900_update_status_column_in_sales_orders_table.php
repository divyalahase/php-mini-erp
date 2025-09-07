<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE `sales_orders` MODIFY `status` ENUM('pending','confirmed','rejected') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `sales_orders` MODIFY `status` ENUM('pending','confirmed') NOT NULL DEFAULT 'pending'");
    }
};