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
        Schema::create('reimburses', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->date('request_date');
            $table->string('transaction_id')->unique();
            $table->string('description');
            $table->string('evidence')->nullable(); 
            $table->decimal('amount', 10, 2);
            $table->enum('transaction_type', ['Debit', 'Credit'])->default('Debit');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reimburses');
    }
};
