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

        Schema::create('game_account_field', function (Blueprint $table) {
            $table->id();
            $table->string('label', 255);
            $table->string('tag', 255)->default('input');
            $table->string('type', 255)->default('text');
            $table->string('name', 255);
            $table->string('priority', 255)->default(1);
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
        Schema::dropIfExists('game_account_field');
    }
};
