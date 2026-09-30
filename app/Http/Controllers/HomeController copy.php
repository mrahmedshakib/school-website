<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\WebsiteSetting;
use App\Models\Notice;

class HomeController extends Controller
{
    /**
     * Home Page
     */
    public function index()
    {
        // Website Settings
        $websiteSetting = WebsiteSetting::first();

        // About School
        $about = About::where('is_delete', 0)
            ->where('status', 1)
            ->latest()
            ->first();

        // Notices
        $notices = Notice::where('is_delete', 0)
            ->where('status', 1)
            ->latest('notice_date')
            ->latest('id')
            ->get();

        return view('frontend.home', compact(
            'websiteSetting',
            'about',
            'notices'
        ));
    }


    /**
     * About Page
     */
    public function about()
    {
        $websiteSetting = WebsiteSetting::first();

        $about = About::where('is_delete', 0)
            ->where('status', 1)
            ->latest()
            ->first();

        return view('frontend.about', compact(
            'websiteSetting',
            'about'
        ));
    }


    /**
     * Notices Page
     */
    public function notices()
    {
        $websiteSetting = WebsiteSetting::first();

        $notices = Notice::where('is_delete', 0)
            ->where('status', 1)
            ->latest('notice_date')
            ->latest('id')
            ->get();

        return view('frontend.notices', compact(
            'websiteSetting',
            'notices'
        ));
    }


    /**
     * Leadership Page
     */
    public function leadership()
    {
        $websiteSetting = WebsiteSetting::first();

        return view('frontend.leadership', compact(
            'websiteSetting'
        ));
    }


    /**
     * Academic Page
     */
    public function academic()
    {
        $websiteSetting = WebsiteSetting::first();

        return view('frontend.academic', compact(
            'websiteSetting'
        ));
    }


    /**
     * Admission Page
     */
    public function admission()
    {
        $websiteSetting = WebsiteSetting::first();

        return view('frontend.admission', compact(
            'websiteSetting'
        ));
    }


    /**
     * Gallery Page
     */
    public function gallery()
    {
        $websiteSetting = WebsiteSetting::first();

        return view('frontend.gallery', compact(
            'websiteSetting'
        ));
    }


    /**
     * Contact Page
     */
    public function contact()
    {
        $websiteSetting = WebsiteSetting::first();

        return view('frontend.contact', compact(
            'websiteSetting'
        ));
    }
}