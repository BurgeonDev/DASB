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
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('rc')->nullable();
            $table->string('rank_full')->unique(); // ✅ unique
            $table->string('rank_cat')->nullable();
            $table->string('rank_cat_code')->nullable();
            $table->string('corres_rank')->nullable();
            $table->string('urdu_rank')->nullable();
            $table->string('af')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranks');
    }
};
