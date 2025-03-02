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
        Schema::create('membership_levels', function (Blueprint $table) {
            $table->id();
            $table->string('key',255);
            $table->string('name',255);
            $table->text('description');
            $table->integer('discount')->comment('chand darsad takhfif dare');
            $table->integer('require_point')->comment('har dollar 100 point , 100 dollar = 10000 point');
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
