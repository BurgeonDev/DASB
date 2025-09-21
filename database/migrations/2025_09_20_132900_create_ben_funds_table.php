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
        Schema::create('ben_funds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pensioner_id')->constrained('pensioners')->onDelete('cascade');
            $table->string('ben_pers_no')->nullable();
            $table->string('banker_name')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('account_no')->nullable();
            $table->string('iban_no')->nullable();
            $table->decimal('amount_received', 12, 2)->nullable();
            $table->date('amount_received_date')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ben_funds');
    }
};
