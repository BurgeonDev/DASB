<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ben_funds', function (Blueprint $table) {
            $table->id();

            // Relation to pensioner
            $table->foreignId('pensioner_id')
                ->constrained('pensioners')
                ->onDelete('cascade');

            // Bank Details
            $table->string('bank_name')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('bank_acct_no')->nullable();
            $table->string('iban_no')->nullable();

            // Fund Details
            $table->decimal('amount_received', 12, 2)->nullable();
            $table->date('amount_received_date')->nullable();
            $table->text('remarks')->nullable();

            // Administrative Info
            $table->string('marital_status')->nullable();
            $table->string('dasb_file_no')->nullable();
            $table->string('originator')->nullable();
            $table->date('originator_ltr_date')->nullable();
            $table->string('originator_ltr_no')->nullable();
            $table->text('originator_contents')->nullable();
            $table->string('status')->default('Received');
            $table->string('hwo_concerned')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ben_funds');
    }
};
