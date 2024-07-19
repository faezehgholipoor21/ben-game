<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up():void
    {
        Schema::create('inquiry', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('company_name',255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('css_style', 255)->default('btn btn-primary');
            $table->integer('product_id');
            $table->integer('number_product');
            $table->longText('description')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down():void
    {
        Schema::dropIfExists('inquiry');
    }
};
