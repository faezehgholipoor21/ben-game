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
    public function up():void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_code',255);
            $table->string('total_price', 250);
            $table->decimal('total_price_usd', 10);
            $table->string('order_status', 250);
            $table->string('payment_status_id', 250);
            $table->string('gateway', 250);
            $table->integer('point_earned')->comment('babate in kharid chand emtiaz kasb karde');
            $table->string('discount_price', 250);
            $table->string('payment_type', 250);
            $table->unsignedBigInteger('discount_type_id');
            $table->string('deleted_at', 500);
            $table->unsignedBigInteger('process_status_id');
            $table->unsignedBigInteger('expert_id');
            $table->string('national_code_image', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists('orders');
    }
};
