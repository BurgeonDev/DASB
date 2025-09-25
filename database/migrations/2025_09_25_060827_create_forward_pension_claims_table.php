<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('forward_pension_claims', function (Blueprint $table) {
            $table->id();
            $table->string('from_location');
            $table->json('to_location'); // ✅ multi-select (array)
            $table->string('pension_no');
            $table->string('claimant');
            $table->string('relation');
            $table->date('date')->default(now());
            $table->json('documents')->nullable(); // ✅ multiple uploads
            $table->text('message')->nullable();   // ✅ new field
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forward_pension_claims');
    }
};
