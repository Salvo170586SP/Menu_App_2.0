<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->defaultValue(1);
            $table->string('color_accordion')->default('#ffffff');
            $table->string('color_item')->default('#000');
            $table->string('font_size')->default('20');
            $table->string('font_size_cat')->default('20');
            $table->string('url_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('styles');
    }
};
