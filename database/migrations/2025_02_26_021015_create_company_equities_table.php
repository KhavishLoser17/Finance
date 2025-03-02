<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('company_equities', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->string('description');
            $table->decimal('amount', 10, 2);
            $table->enum('transaction_type', ['Debit', 'Credit']);
            $table->date('date');
            $table->string('status')->default('Approved');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_equities');
    }
};
