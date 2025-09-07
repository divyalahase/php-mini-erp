<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_no')->unique();
        $table->foreignId('customer_id')->constrained()->onDelete('cascade');
        $table->date('order_date');
        $table->enum('status',['pending','confirmed'])->default('pending');
        $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
        $table->decimal('total_amount', 12, 2)->default(0);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_orders');
    }
};
