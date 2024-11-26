<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     *
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',255)->nullable()->default(null);
            $table->string('last_name',255)->nullable()->default(null);
            $table->string('mobile',11)->nullable()->default(null);
            $table->unsignedTinyInteger('gender')->nullable()->default(null);
            $table->string('national_code',11)->nullable()->default(null);
            $table->string('user_image',255)->nullable()->default('admin/assets/images/placeholders/user_placeholder.png');
            $table->date('birth_day')->nullable()->default(null);
            $table->string('email',255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',255);
            $table->string('address',255)->nullable()->default(null);
            $table->unsignedInteger('is_active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     *
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
