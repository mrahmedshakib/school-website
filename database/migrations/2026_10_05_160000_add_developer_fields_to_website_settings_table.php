<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->string('developer_name')->nullable()->default('ইমতিয়াজ আহমেদ')->after('meta_keywords');
            $table->string('developer_name_en')->nullable()->default('Imtiaz Ahmed')->after('developer_name');
            $table->string('developer_username')->nullable()->default('mrahmedshakib')->after('developer_name_en');
            $table->string('developer_role')->nullable()->default('Full-Stack Software Engineer & Architect')->after('developer_username');
            $table->string('developer_organization')->nullable()->default('Mysoftheaven (BD) LTD. • Dhaka')->after('developer_role');
            $table->string('developer_email')->nullable()->default('ahmedshakib37@gmail.com')->after('developer_organization');
            $table->string('developer_phone')->nullable()->default('01767056733')->after('developer_email');
            $table->string('developer_whatsapp')->nullable()->default('01767056733')->after('developer_phone');
            $table->string('developer_photo')->nullable()->default('https://avatars.githubusercontent.com/u/36819643?v=4')->after('developer_whatsapp');
            $table->string('developer_portfolio')->nullable()->default('https://mrahmedshakib.github.io/')->after('developer_photo');
            $table->string('developer_github')->nullable()->default('https://github.com/mrahmedshakib')->after('developer_portfolio');
            $table->string('developer_linkedin')->nullable()->default('https://www.linkedin.com/in/mrahmedshakib/')->after('developer_github');
            $table->text('developer_whatsapp_message')->nullable()->after('developer_linkedin');
            $table->text('developer_contact_note')->nullable()->after('developer_whatsapp_message');
        });

        // Populate existing row if present with initial DB data
        $defaults = [
            'developer_name' => 'ইমতিয়াজ আহমেদ',
            'developer_name_en' => 'Imtiaz Ahmed',
            'developer_username' => 'mrahmedshakib',
            'developer_role' => 'Full-Stack Software Engineer & Architect',
            'developer_organization' => 'Mysoftheaven (BD) LTD. • Dhaka',
            'developer_email' => 'ahmedshakib37@gmail.com',
            'developer_phone' => '01767056733',
            'developer_whatsapp' => '01767056733',
            'developer_photo' => 'https://avatars.githubusercontent.com/u/36819643?v=4',
            'developer_portfolio' => 'https://mrahmedshakib.github.io/',
            'developer_github' => 'https://github.com/mrahmedshakib',
            'developer_linkedin' => 'https://www.linkedin.com/in/mrahmedshakib/',
            'developer_whatsapp_message' => 'হ্যালো ইমতিয়াজ ভাই, আমি আপনার তৈরিকৃত ওয়েবসাইটটি দেখেছি। নতুন ওয়েবসাইট/সফটওয়্যার নিয়ে কথা বলতে চাই।',
            'developer_contact_note' => 'নতুন ওয়েবসাইট, সফটওয়্যার বা যে কোনো প্রজেক্ট সংক্রান্ত বিষয়ে সরাসরি যোগাযোগ করতে পারেন:',
        ];

        DB::table('website_settings')->update($defaults);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn([
                'developer_name',
                'developer_name_en',
                'developer_username',
                'developer_role',
                'developer_organization',
                'developer_email',
                'developer_phone',
                'developer_whatsapp',
                'developer_photo',
                'developer_portfolio',
                'developer_github',
                'developer_linkedin',
                'developer_whatsapp_message',
                'developer_contact_note',
            ]);
        });
    }
};
