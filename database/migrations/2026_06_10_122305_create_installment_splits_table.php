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
        Schema::create('installment_splits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('installment_id')->constrained('installments')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('paid_amount', 10, 2)->default(0.00);
            $table->decimal('owed_amount', 10, 2)->default(0.00);
            $table->enum('status', ['pending', 'settled'])->default('pending');
            $table->timestamps();

            $table->unique(['installment_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installment_splits');
    }
};
