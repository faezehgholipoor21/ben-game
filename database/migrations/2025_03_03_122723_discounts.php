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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_code',255);
            $table->string('discount_name',255);
            $table->timestamp('expired_time');
            $table->integer('limit');
            $table->integer('used')->comment('neshoon mide chand bar estefade shode')->default(0);
            $table->integer('status')->comment('active boodan ya naboodane takhfif ya morede dige');
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
        //
    }
};
