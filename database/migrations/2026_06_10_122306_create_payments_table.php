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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['pix', 'cash', 'transfer'])->default('pix');
            $table->text('pix_qr_code')->nullable();
            $table->string('receipt_path')->nullable();
            $table->enum('status', ['pending_confirmation', 'confirmed', 'rejected'])->default('pending_confirmation');
            $table->dateTime('payment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
