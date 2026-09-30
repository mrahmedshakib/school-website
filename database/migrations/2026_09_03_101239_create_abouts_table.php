<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');

            $table->string('image')->nullable();

            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();

            $table->boolean('status')->default(true);
            $table->boolean('is_delete')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};