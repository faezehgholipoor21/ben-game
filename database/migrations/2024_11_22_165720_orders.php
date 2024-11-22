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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_code', 255)->nullable()->default(null);
            $table->string('address', 255)->nullable()->default(null);
            $table->unsignedBigInteger('shipping_price')->nullable()->default(null);
            $table->string('discount_code', 255)->nullable()->default(null);
            $table->unsignedBigInteger('discount_price')->nullable()->default(null);
            $table->unsignedBigInteger('total_price');
            $table->unsignedBigInteger('payment_status_id');
            $table->unsignedBigInteger('order_status')->default(1);
            $table->string('transaction_number',255)->nullable()->default(null);
            $table->string('fee',255)->nullable()->default(null);
            $table->string('card_pan',255)->nullable()->default(null);
            $table->string('gateway',255)->nullable()->default(null);
            $table->string('authority',255)->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');

    }
};
