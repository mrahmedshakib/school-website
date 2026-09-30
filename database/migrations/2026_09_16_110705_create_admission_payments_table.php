<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('admission_application_id')
                ->constrained('admission_applications')
                ->cascadeOnDelete();

            $table->string('payment_no')->unique();

            $table->decimal('amount', 10, 2);

            $table->string('payment_method');

            $table->string('account_number')->nullable();

            $table->string('transaction_id');

            $table->string('payment_proof')->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            $table->text('admin_note')->nullable();

            $table->timestamp('paid_at')->nullable();

            $table->timestamp('verified_at')->nullable();

            $table->timestamps();

            $table->index('transaction_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_payments');
    }
};