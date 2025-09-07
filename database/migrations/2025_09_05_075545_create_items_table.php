<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->unique();
            $table->string('item_name');
            $table->string('unit_of_measure');
            $table->decimal('opening_stock')->default(0);
            $table->decimal('stock')->default(0); 
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
}
