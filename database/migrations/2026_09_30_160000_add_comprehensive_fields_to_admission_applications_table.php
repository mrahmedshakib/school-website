<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admission_applications', function (Blueprint $table) {
            $table->string('academic_year', 10)->nullable()->default('2026')->after('application_no');
            $table->string('student_name_bn')->nullable()->after('student_name');
            $table->string('student_name_en')->nullable()->after('student_name_bn');
            $table->string('group_name', 50)->nullable()->after('class');
            $table->string('blood_group', 10)->nullable()->after('gender');
            $table->string('birth_reg_no', 30)->nullable()->after('date_of_birth');
            $table->string('religion', 30)->nullable()->after('blood_group');
            $table->string('nationality', 50)->default('বাংলাদেশী')->after('religion');

            $table->string('father_name_en')->nullable()->after('father_name');
            $table->string('father_nid', 30)->nullable()->after('father_name_en');
            $table->string('father_education', 100)->nullable()->after('father_nid');

            $table->string('mother_name_en')->nullable()->after('mother_name');
            $table->string('mother_nid', 30)->nullable()->after('mother_name_en');
            $table->string('mother_education', 100)->nullable()->after('mother_nid');

            $table->text('permanent_address')->nullable()->after('address');
            $table->text('present_address')->nullable()->after('permanent_address');
            $table->text('guardian_info')->nullable()->after('present_address');
            $table->text('father_occupation_info')->nullable()->after('guardian_info');
            $table->text('other_children_info')->nullable()->after('father_occupation_info');
            $table->string('contact_mobile', 20)->nullable()->after('guardian_phone');

            // Lottery & Final Admission Confirmation
            $table->boolean('is_lottery_selected')->default(false)->after('status');
            $table->integer('lottery_rank')->nullable()->after('is_lottery_selected');
            $table->string('lottery_quota', 50)->nullable()->default('general')->after('lottery_rank');
            $table->timestamp('lottery_drawn_at')->nullable()->after('lottery_quota');
            $table->boolean('is_confirmed')->default(false)->after('lottery_drawn_at');
            $table->timestamp('confirmed_at')->nullable()->after('is_confirmed');
        });

        // Expand status enum to support lottery & confirmation
        try {
            DB::statement("
                ALTER TABLE admission_applications
                MODIFY status ENUM(
                    'pending',
                    'payment_pending',
                    'selected_lottery',
                    'approved',
                    'rejected'
                ) NOT NULL DEFAULT 'pending'
            ");
        } catch (\Throwable $e) {
            // Ignore if driver differs
        }
    }

    public function down(): void
    {
        Schema::table('admission_applications', function (Blueprint $table) {
            $table->dropColumn([
                'academic_year',
                'student_name_bn',
                'student_name_en',
                'group_name',
                'blood_group',
                'birth_reg_no',
                'religion',
                'nationality',
                'father_name_en',
                'father_nid',
                'father_education',
                'mother_name_en',
                'mother_nid',
                'mother_education',
                'permanent_address',
                'present_address',
                'guardian_info',
                'father_occupation_info',
                'other_children_info',
                'contact_mobile',
                'is_lottery_selected',
                'lottery_rank',
                'lottery_quota',
                'lottery_drawn_at',
                'is_confirmed',
                'confirmed_at',
            ]);
        });
    }
};
