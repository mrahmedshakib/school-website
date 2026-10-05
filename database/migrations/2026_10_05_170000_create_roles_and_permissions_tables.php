<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_system')->default(false); // System roles (like Super Admin) cannot be deleted
            $table->timestamps();
        });

        // 2. Permissions table
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('group'); // e.g., Notices, Academic, Admissions, Administration, Media, Settings, Users
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // 3. Permission - Role Pivot table
        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
            $table->primary(['role_id', 'permission_id']);
        });

        // 4. Update Users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('password')->constrained('roles')->nullOnDelete();
            $table->string('phone')->nullable()->after('role_id');
            $table->boolean('status')->default(true)->after('phone'); // 1 = Active, 0 = Inactive
        });

        // 5. Seed Initial Permissions
        $permissions = [
            // Dashboard
            ['name' => 'View Dashboard (ড্যাশবোর্ড দর্শন)', 'slug' => 'dashboard.view', 'group' => 'Dashboard', 'description' => 'Access and view admin statistics dashboard'],

            // Notices & Communication
            ['name' => 'View Notices (নোটিশ দেখা)', 'slug' => 'notices.view', 'group' => 'Notices', 'description' => 'View list of notices'],
            ['name' => 'Manage Notices (নোটিশ ব্যবস্থাপনা)', 'slug' => 'notices.manage', 'group' => 'Notices', 'description' => 'Create, edit and delete notices'],
            ['name' => 'View Messages (যোগাযোগ বার্তা দর্শন)', 'slug' => 'contact_messages.view', 'group' => 'Communication', 'description' => 'View user contact messages'],
            ['name' => 'Manage Messages (বার্তা ব্যবস্থাপনা)', 'slug' => 'contact_messages.manage', 'group' => 'Communication', 'description' => 'Mark as read/unread and delete messages'],

            // Academic Hub
            ['name' => 'Manage Syllabuses (সিলেবাস ব্যবস্থাপনা)', 'slug' => 'academic.syllabuses', 'group' => 'Academic Hub', 'description' => 'Manage class syllabuses'],
            ['name' => 'Manage Routines (ক্লাস ও পরীক্ষার রুটিন)', 'slug' => 'academic.routines', 'group' => 'Academic Hub', 'description' => 'Manage class and examination routines'],
            ['name' => 'Manage Subjects (বিষয়সমূহ ব্যবস্থাপনা)', 'slug' => 'academic.subjects', 'group' => 'Academic Hub', 'description' => 'Manage academic subjects and groups'],
            ['name' => 'Manage Results & Marks (ফলাফল ও মার্কশিট)', 'slug' => 'academic.results', 'group' => 'Academic Hub', 'description' => 'Manage gazette results and student marks'],
            ['name' => 'Manage Enrolled Students (শিক্ষার্থী ডেটাবেজ)', 'slug' => 'academic.students', 'group' => 'Academic Hub', 'description' => 'Manage enrolled students directory'],

            // Admissions Hub
            ['name' => 'Manage Circulars (ভর্তি বিজ্ঞপ্তি)', 'slug' => 'admissions.circulars', 'group' => 'Admissions Hub', 'description' => 'Manage admission circulars and guidelines'],
            ['name' => 'Manage Applications (ভর্তি আবেদনসমূহ)', 'slug' => 'admissions.applications', 'group' => 'Admissions Hub', 'description' => 'View, verify and approve admission applications'],
            ['name' => 'Conduct Lottery (ভর্তি লটারি ও মেধা তালিকা)', 'slug' => 'admissions.lottery', 'group' => 'Admissions Hub', 'description' => 'Run admission lottery and manage quotas'],
            ['name' => 'Manage Payments (ভর্তি ফি পেমেন্ট)', 'slug' => 'admissions.payments', 'group' => 'Admissions Hub', 'description' => 'View and verify admission payment transactions'],

            // Institutional & Staff
            ['name' => 'Manage Administration (প্রশাসন ও পরিচালনা পর্ষদ)', 'slug' => 'administration.manage', 'group' => 'Institutional', 'description' => 'Manage governing body and committee members'],
            ['name' => 'Manage Teachers & Staff (শিক্ষক ও কর্মচারী)', 'slug' => 'teachers.manage', 'group' => 'Institutional', 'description' => 'Manage teachers and institutional staff'],
            ['name' => 'Manage About & Vision (আমাদের কথা ও লক্ষ্য)', 'slug' => 'institution.about', 'group' => 'Institutional', 'description' => 'Manage about us and mission-vision content'],

            // Media & Content
            ['name' => 'Manage Sliders (ব্যানার স্লাইডার)', 'slug' => 'sliders.manage', 'group' => 'Media & Content', 'description' => 'Manage homepage sliders and banners'],
            ['name' => 'Manage News & Events (সংবাদ ও ইভেন্ট)', 'slug' => 'news_events.manage', 'group' => 'Media & Content', 'description' => 'Manage news posts and upcoming events'],
            ['name' => 'Manage Galleries (ছবি ও ভিডিও গ্যালারি)', 'slug' => 'galleries.manage', 'group' => 'Media & Content', 'description' => 'Manage photo and video galleries'],
            ['name' => 'Manage Publications (ম্যাগাজিন ও প্রকাশনা)', 'slug' => 'publications.manage', 'group' => 'Media & Content', 'description' => 'Manage school magazines and publications'],

            // Settings & Security
            ['name' => 'Manage Settings (ওয়েবসাইট ও ডেভেলপার সেটিংস)', 'slug' => 'settings.manage', 'group' => 'System Settings', 'description' => 'Manage school branding, contact and developer settings'],

            // Access Control / RBAC
            ['name' => 'View Users (ব্যবহারকারী তালিকা দেখা)', 'slug' => 'users.view', 'group' => 'Access Control', 'description' => 'View list of admin users'],
            ['name' => 'Manage Users (ব্যবহারকারী তৈরি ও নিয়ন্ত্রণ)', 'slug' => 'users.manage', 'group' => 'Access Control', 'description' => 'Create, edit, toggle status and delete users'],
            ['name' => 'View Roles (রোল ও পারমিশন দর্শন)', 'slug' => 'roles.view', 'group' => 'Access Control', 'description' => 'View list of roles and assigned permissions'],
            ['name' => 'Manage Roles (রোল তৈরি ও পারমিশন অ্যাসাইন)', 'slug' => 'roles.manage', 'group' => 'Access Control', 'description' => 'Create, edit and assign permissions to roles'],
        ];

        $now = now();
        foreach ($permissions as &$perm) {
            $perm['created_at'] = $now;
            $perm['updated_at'] = $now;
        }
        DB::table('permissions')->insert($permissions);

        // 6. Seed Default Roles
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'সম্পূর্ণ সিস্টেমের সর্বোচ্চ নিয়ন্ত্রণ ও সকল পারমিশন অধিকারপ্রাপ্ত।',
                'is_system' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'দৈনন্দিন প্রশাসনিক কার্যক্রম, শিক্ষক, শিক্ষার্থী ও কনটেন্ট পরিচালনার অধিকারপ্রাপ্ত।',
                'is_system' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Academic In-Charge / Teacher',
                'slug' => 'teacher',
                'description' => 'রুটিন, সিলেবাস, বিষয়, ফলাফল ও মার্কশিট পরিচালনার অধিকারপ্রাপ্ত।',
                'is_system' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Admission Officer',
                'slug' => 'admission-officer',
                'description' => 'ভর্তি বিজ্ঞপ্তি, আবেদন যাচাই, লটারি ও ভর্তি ফি পেমেন্ট পরিচালনার অধিকারপ্রাপ্ত।',
                'is_system' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Content Editor',
                'slug' => 'editor',
                'description' => 'নোটিশ, সংবাদ, ইভেন্ট, স্লাইডার, প্রকাশনা ও গ্যালারি পরিচালনার অধিকারপ্রাপ্ত।',
                'is_system' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        DB::table('roles')->insert($roles);

        // 7. Assign Permissions to Roles
        $allPermissions = DB::table('permissions')->get()->keyBy('slug');
        $superAdminRoleId = DB::table('roles')->where('slug', 'super-admin')->value('id');
        $adminRoleId = DB::table('roles')->where('slug', 'admin')->value('id');
        $teacherRoleId = DB::table('roles')->where('slug', 'teacher')->value('id');
        $admissionRoleId = DB::table('roles')->where('slug', 'admission-officer')->value('id');
        $editorRoleId = DB::table('roles')->where('slug', 'editor')->value('id');

        // Super Admin gets all permissions
        $pivotData = [];
        foreach ($allPermissions as $perm) {
            $pivotData[] = ['role_id' => $superAdminRoleId, 'permission_id' => $perm->id];
        }

        // Admin gets all except roles.manage and system-critical
        foreach ($allPermissions as $perm) {
            $pivotData[] = ['role_id' => $adminRoleId, 'permission_id' => $perm->id];
        }

        // Teacher Permissions
        $teacherPermSlugs = [
            'dashboard.view',
            'notices.view',
            'academic.syllabuses',
            'academic.routines',
            'academic.subjects',
            'academic.results',
            'academic.students',
        ];
        foreach ($teacherPermSlugs as $slug) {
            if (isset($allPermissions[$slug])) {
                $pivotData[] = ['role_id' => $teacherRoleId, 'permission_id' => $allPermissions[$slug]->id];
            }
        }

        // Admission Officer Permissions
        $admissionPermSlugs = [
            'dashboard.view',
            'notices.view',
            'admissions.circulars',
            'admissions.applications',
            'admissions.lottery',
            'admissions.payments',
            'contact_messages.view',
        ];
        foreach ($admissionPermSlugs as $slug) {
            if (isset($allPermissions[$slug])) {
                $pivotData[] = ['role_id' => $admissionRoleId, 'permission_id' => $allPermissions[$slug]->id];
            }
        }

        // Editor Permissions
        $editorPermSlugs = [
            'dashboard.view',
            'notices.view',
            'notices.manage',
            'sliders.manage',
            'news_events.manage',
            'galleries.manage',
            'publications.manage',
            'institution.about',
        ];
        foreach ($editorPermSlugs as $slug) {
            if (isset($allPermissions[$slug])) {
                $pivotData[] = ['role_id' => $editorRoleId, 'permission_id' => $allPermissions[$slug]->id];
            }
        }

        DB::table('permission_role')->insert($pivotData);

        // 8. Assign Super Admin role to the existing user(s)
        DB::table('users')->update([
            'role_id' => $superAdminRoleId,
            'status' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id', 'phone', 'status']);
        });

        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
