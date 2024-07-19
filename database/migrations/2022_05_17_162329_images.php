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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image_name', 255);
            $table->integer('image_type_id');
            $table->boolean('is_main');
            $table->string('image_css',255)->default('btn btn-dark');
            $table->string('css_title',255)->default('معمولی');
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
        Schema::dropIfExists('image_name');
    }
};
