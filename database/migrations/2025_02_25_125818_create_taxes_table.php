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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('transaction_id')->unique();
            $table->string('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['Bank Transfer', 'Check', 'Cash','E-Wallet']);
            $table->date('schedule_release_date');
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
        Schema::dropIfExists('taxes');
    }
};
