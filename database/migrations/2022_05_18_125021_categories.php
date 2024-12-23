<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('cat_title', 500);
            $table->string('cat_slug', 500);
            $table->string('cat_image', 500)->nullable();
            $table->text('cat_content')->nullable();
            $table->string('cat_meta_keywords', 500)->nullable();
            $table->string('cat_meta_description', 500)->nullable();
            $table->boolean('parent')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
