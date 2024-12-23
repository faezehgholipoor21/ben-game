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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('tiny_text', 255)->nullable()->default(null);
            $table->string('bold_text', 255);
            $table->string('src', 255);
            $table->boolean('is_active')->default(1);
            $table->string('css_style',255)->default('btn btn-success text-white');
            $table->string('status_text',255)->default('قابل نمایش در سایت');
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
        Schema::dropIfExists('banners');
    }
};