<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pensioners', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_entry')->nullable();
            $table->string('prefix')->nullable();
            $table->string('personal_no')->unique();
            $table->foreignId('rank_id')->nullable()->constrained('ranks')->nullOnDelete();
            $table->string('trade')->nullable();
            $table->string('name');
            $table->foreignId('regt_corps_id')->nullable()->constrained('regt_corps')->nullOnDelete();
            $table->string('type_of_pension')->nullable();
            $table->string('parent_unit')->nullable();
            $table->string('nok_name')->nullable();
            $table->string('nok_relation')->nullable();
            $table->string('village')->nullable();
            $table->string('post_office')->nullable();
            $table->string('uc_name')->nullable();
            $table->string('tehsil')->nullable();
            $table->string('district')->nullable();
            $table->string('present_address')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('cnic_no')->nullable();
            $table->decimal('net_pension', 12, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensioners');
    }
};
