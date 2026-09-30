<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_visitors', function (Blueprint $table) {
            $table->id();

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->date('visit_date');

            $table->timestamps();

            $table->index('visit_date');
            $table->index('ip_address');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_visitors');
    }
};