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
        Schema::create('subscribe_history_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subscribe_id');
            $table->text('description');
            $table->decimal('price',10);
            $table->integer('status')->comment('pay status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subscribe_id')->references('id')->on('subscribe');

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
