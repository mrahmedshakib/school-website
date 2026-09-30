<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add bilingual fields to teachers table
        Schema::table('teachers', function (Blueprint $table) {
            if (!Schema::hasColumn('teachers', 'name_bn')) {
                $table->string('name_bn')->nullable()->after('name');
                $table->string('name_en')->nullable()->after('name_bn');
                $table->string('designation_bn')->nullable()->after('designation');
                $table->string('designation_en')->nullable()->after('designation_bn');
                $table->string('subject_bn')->nullable()->after('subject');
                $table->string('subject_en')->nullable()->after('subject_bn');
                $table->string('qualification_bn')->nullable()->after('subject_en');
                $table->string('qualification_en')->nullable()->after('qualification_bn');
            }
        });

        // Populate existing teachers data
        DB::statement("UPDATE teachers SET name_bn = COALESCE(name_bn, name), name_en = COALESCE(name_en, name), designation_bn = COALESCE(designation_bn, designation), designation_en = COALESCE(designation_en, designation), subject_bn = COALESCE(subject_bn, subject), subject_en = COALESCE(subject_en, subject)");

        // 2. Add bilingual fields to notices table
        Schema::table('notices', function (Blueprint $table) {
            if (!Schema::hasColumn('notices', 'title_bn')) {
                $table->string('title_bn')->nullable()->after('title');
                $table->string('title_en')->nullable()->after('title_bn');
                $table->text('description_bn')->nullable()->after('description');
                $table->text('description_en')->nullable()->after('description_bn');
                $table->string('category')->nullable()->default('Academic')->after('file');
            }
        });

        // Populate existing notices data
        DB::statement("UPDATE notices SET title_bn = COALESCE(title_bn, title), title_en = COALESCE(title_en, title), description_bn = COALESCE(description_bn, description), description_en = COALESCE(description_en, description)");

        // 3. Academic Syllabuses
        if (!Schema::hasTable('academic_syllabuses')) {
            Schema::create('academic_syllabuses', function (Blueprint $table) {
                $table->id();
                $table->string('title_bn');
                $table->string('title_en')->nullable();
                $table->string('class');
                $table->string('academic_year')->nullable()->default(date('Y'));
                $table->string('subject_name_bn')->nullable();
                $table->string('subject_name_en')->nullable();
                $table->string('file_path')->nullable();
                $table->text('description_bn')->nullable();
                $table->text('description_en')->nullable();
                $table->boolean('status')->default(1);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // 4. Class Routines
        if (!Schema::hasTable('class_routines')) {
            Schema::create('class_routines', function (Blueprint $table) {
                $table->id();
                $table->string('title_bn');
                $table->string('title_en')->nullable();
                $table->string('class');
                $table->string('section')->nullable();
                $table->string('shift')->nullable()->default('Day');
                $table->string('academic_year')->nullable()->default(date('Y'));
                $table->string('file_path')->nullable();
                $table->boolean('status')->default(1);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // 5. Exam Routines
        if (!Schema::hasTable('exam_routines')) {
            Schema::create('exam_routines', function (Blueprint $table) {
                $table->id();
                $table->string('title_bn');
                $table->string('title_en')->nullable();
                $table->string('exam_name_bn')->nullable();
                $table->string('exam_name_en')->nullable();
                $table->string('class');
                $table->string('academic_year')->nullable()->default(date('Y'));
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->string('file_path')->nullable();
                $table->boolean('status')->default(1);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // 6. Academic Subjects
        if (!Schema::hasTable('academic_subjects')) {
            Schema::create('academic_subjects', function (Blueprint $table) {
                $table->id();
                $table->string('name_bn');
                $table->string('name_en')->nullable();
                $table->string('code')->nullable();
                $table->string('class');
                $table->string('group_name')->nullable()->default('General');
                $table->string('type')->default('Compulsory'); // Compulsory, Elective, Optional
                $table->integer('total_marks')->default(100);
                $table->integer('theory_marks')->nullable();
                $table->integer('practical_marks')->nullable();
                $table->integer('viva_marks')->nullable();
                $table->text('description_bn')->nullable();
                $table->text('description_en')->nullable();
                $table->boolean('status')->default(1);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // 7. Exam Results (Gazettes & Overall Results)
        if (!Schema::hasTable('exam_results')) {
            Schema::create('exam_results', function (Blueprint $table) {
                $table->id();
                $table->string('title_bn');
                $table->string('title_en')->nullable();
                $table->string('exam_name_bn')->nullable();
                $table->string('exam_name_en')->nullable();
                $table->string('class')->nullable();
                $table->string('academic_year')->nullable()->default(date('Y'));
                $table->date('publish_date')->nullable();
                $table->string('file_path')->nullable();
                $table->integer('total_students')->default(0);
                $table->integer('passed_students')->default(0);
                $table->integer('failed_students')->default(0);
                $table->integer('gpa5_count')->default(0);
                $table->decimal('pass_rate', 5, 2)->default(100.00);
                $table->boolean('status')->default(1);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // 8. Student Individual Searchable Results
        if (!Schema::hasTable('student_marks')) {
            Schema::create('student_marks', function (Blueprint $table) {
                $table->id();
                $table->string('exam_name_bn');
                $table->string('exam_name_en')->nullable();
                $table->string('academic_year')->default(date('Y'));
                $table->string('class');
                $table->string('section')->nullable();
                $table->string('roll_no');
                $table->string('student_id')->nullable();
                $table->string('student_name_bn');
                $table->string('student_name_en')->nullable();
                $table->decimal('gpa', 4, 2)->default(0.00);
                $table->string('grade')->default('A+');
                $table->integer('total_marks')->default(0);
                $table->enum('result_status', ['PASSED', 'FAILED'])->default('PASSED');
                $table->json('marks_details')->nullable(); // Subject wise marks: [{subject_bn, subject_en, marks, grade, point}]
                $table->text('remarks')->nullable();
                $table->timestamps();
            });
        }

        // 9. Students (Student Directory / Enrolled Students)
        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->id();
                $table->string('student_id')->nullable()->unique();
                $table->string('name_bn');
                $table->string('name_en')->nullable();
                $table->string('class');
                $table->string('section')->nullable();
                $table->string('roll_no');
                $table->enum('gender', ['male', 'female', 'other'])->default('male');
                $table->string('academic_year')->default(date('Y'));
                $table->string('guardian_name_bn')->nullable();
                $table->string('guardian_name_en')->nullable();
                $table->string('guardian_phone')->nullable();
                $table->string('blood_group')->nullable();
                $table->string('photo')->nullable();
                $table->boolean('status')->default(1);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // 10. School Publications & Magazines
        if (!Schema::hasTable('school_publications')) {
            Schema::create('school_publications', function (Blueprint $table) {
                $table->id();
                $table->enum('type', ['magazine', 'publication'])->default('magazine');
                $table->string('title_bn');
                $table->string('title_en')->nullable();
                $table->string('edition_bn')->nullable();
                $table->string('edition_en')->nullable();
                $table->date('publish_date')->nullable();
                $table->string('academic_year')->nullable()->default(date('Y'));
                $table->string('cover_image')->nullable();
                $table->string('file_path')->nullable();
                $table->text('description_bn')->nullable();
                $table->text('description_en')->nullable();
                $table->boolean('status')->default(1);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // 11. Video Gallery
        if (!Schema::hasTable('video_galleries')) {
            Schema::create('video_galleries', function (Blueprint $table) {
                $table->id();
                $table->string('title_bn');
                $table->string('title_en')->nullable();
                $table->string('youtube_url');
                $table->string('video_id')->nullable();
                $table->string('category_bn')->nullable()->default('অনুষ্ঠান');
                $table->string('category_en')->nullable()->default('Events');
                $table->string('thumbnail')->nullable();
                $table->text('description_bn')->nullable();
                $table->text('description_en')->nullable();
                $table->boolean('status')->default(1);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('video_galleries');
        Schema::dropIfExists('school_publications');
        Schema::dropIfExists('students');
        Schema::dropIfExists('student_marks');
        Schema::dropIfExists('exam_results');
        Schema::dropIfExists('academic_subjects');
        Schema::dropIfExists('exam_routines');
        Schema::dropIfExists('class_routines');
        Schema::dropIfExists('academic_syllabuses');
    }
};
