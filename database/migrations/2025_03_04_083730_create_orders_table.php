<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('shipping_service_id');
            $table->foreignId('payment_account_id');
            $table->foreignId('provider_id');
            $table->foreignId('city_id');
            $table->foreignId('district_id');
            $table->foreignId('village_id');
            $table->text('address_detail');
            $table->string('awb_bill');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'process', 'delivered', 'failed', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
