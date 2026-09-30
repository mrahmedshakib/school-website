<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('subject')->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('image')->nullable();

            $table->integer('sort_order')->default(0);

            $table->boolean('status')->default(1);
            $table->boolean('is_delete')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};