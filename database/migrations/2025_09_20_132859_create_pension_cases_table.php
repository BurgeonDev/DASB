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
        Schema::create('pension_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pensioner_id')->constrained('pensioners')->onDelete('cascade');
            $table->string('pen_ex_no')->nullable();
            $table->string('status')->nullable();
            $table->date('pen_do_entry')->nullable();
            $table->string('reg_ser_no')->nullable();
            $table->string('gp_insurance_claim_ltr')->nullable();
            $table->string('benfund_claim_ltr')->nullable();
            $table->string('dasb_ltr_no')->nullable();
            $table->date('dasb_ltr_date')->nullable();
            $table->date('finalized_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pension_cases');
    }
};
