<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pensioner_id')->constrained('pensioners')->onDelete('cascade');

            $table->string('name');
            $table->string('relation'); // dropdown in Resource
            $table->date('dob')->nullable();
            $table->date('do_death')->nullable();
            $table->date('do_marriage')->nullable();
            $table->string('education')->nullable();
            $table->string('profession')->nullable();
            $table->string('marital_status')->nullable(); // dropdown
            $table->string('disability')->nullable();     // dropdown yes/no
            $table->string('cnic_no')->nullable();
            $table->string('id_marks')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('source_of_income')->nullable();
            $table->decimal('monthly_income', 12, 2)->nullable();
            $table->string('remarks')->nullable();

            // Pension linkage
            $table->string('psb_no')->nullable();
            $table->string('ppo_no')->nullable();
            $table->string('gpo')->nullable();
            $table->string('pdo')->nullable();
            $table->decimal('net_pension', 12, 2)->nullable();

            // Banking
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_acct_no')->nullable();
            $table->string('iban_no')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
