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
        Schema::create('regt_corps', function (Blueprint $table) {
            $table->id();
            $table->string('force_code')->nullable();
            $table->string('force');
            $table->string('regt_code')->nullable();
            $table->string('rw')->nullable();
            $table->string('rw_loc')->nullable();
            $table->string('rw_tel_no')->nullable();
            $table->string('urdu_rw')->nullable();
            $table->string('urdu_rw_loc')->nullable();
            $table->string('urdu_regt')->nullable();
            $table->text('text_sro')->nullable();
            $table->text('urdu_text_sro')->nullable();
            $table->timestamps();

            $table->unique(['force', 'regt_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regt_corps');
    }
};
