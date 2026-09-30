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
        Schema::create('administrations', function (Blueprint $table) {

            $table->id();

            // Basic Information
            $table->string('name');
            $table->string('designation');

            // Contact Information
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // Description
            $table->text('description')->nullable();

            // Profile Image
            $table->string('image')->nullable();

            // Ordering
            $table->unsignedInteger('sort_order')->default(0);

            // Status
            $table->boolean('status')->default(true);

            // Soft Delete
            $table->boolean('is_delete')->default(false);

            $table->timestamps();

            // Indexes for faster queries
            $table->index(['is_delete', 'status']);
            $table->index(['is_delete', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrations');
    }
};