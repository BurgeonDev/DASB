<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pension_categories', function (Blueprint $table) {
            $table->id();
            $table->string('pen_cat');
            $table->string('pen_cat_code')->nullable();
            $table->string('pen_type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pension_categories');
    }
};
