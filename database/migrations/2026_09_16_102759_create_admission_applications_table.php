<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_applications', function (Blueprint $table) {
            $table->id();

            $table->string('application_no')->unique();

            // Student Information
            $table->string('student_name');
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('class');
            $table->string('previous_school')->nullable();

            // Guardian Information
            $table->string('father_name');
            $table->string('mother_name')->nullable();
            $table->string('guardian_phone');
            $table->string('email')->nullable();
            $table->text('address');

            // Documents
            $table->string('student_photo')->nullable();
            $table->string('birth_certificate')->nullable();

            // Application Status
            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            $table->text('admin_note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_applications');
    }
};