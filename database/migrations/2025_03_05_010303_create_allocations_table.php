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
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->string('department');
            $table->string('description');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['Bank Transfer', 'Check', 'Cash','E-Wallet']);
            $table->date('date');
            $table->enum('transaction_type', ['Debit', 'Credit']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocations');
    }
};
