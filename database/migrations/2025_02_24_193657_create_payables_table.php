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
        Schema::create('payables', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('transaction_id')->unique();
            $table->text('description');
            $table->string('request_by');
            $table->decimal('notes_amount', 10, 2)->nullable();
            $table->date('request_date');
            $table->string('evidence')->nullable(); // File path
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
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
        Schema::dropIfExists('payables');

    }
};
