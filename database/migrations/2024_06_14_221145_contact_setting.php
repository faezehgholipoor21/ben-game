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
        Schema::create('contact_setting', function (Blueprint $table) {
            $table->id();
            $table->string('address',255)->nullable()->default(null);
            $table->string('mobile',11)->nullable()->default(null);
            $table->string('phone',11)->nullable()->default(null);
            $table->string('email_one',255)->nullable()->default(null);
            $table->string('email_two',255)->nullable()->default(null);
            $table->longText('open_store');
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
        Schema::dropIfExists('settingContact');
    }
};
