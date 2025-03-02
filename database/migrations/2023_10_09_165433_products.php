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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 500);
            $table->string('product_nickname', 500);
            $table->string('product_image', 500)->nullable();
            $table->decimal('product_price',10);
            $table->integer('product_force_price')->default(0);
            $table->integer('cat_id');
            $table->integer('inventory')->default(1);
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
        Schema::dropIfExists('products');
    }
};
