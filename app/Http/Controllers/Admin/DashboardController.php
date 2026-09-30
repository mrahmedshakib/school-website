<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\WebsiteVisitor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Content Statistics
        |--------------------------------------------------------------------------
        */

        $totalNotices = Notice::where('is_delete', 0)->count();

        // News / Events / Gallery পরে তৈরি হলে dynamic করা হবে
        $totalNews = 0;
        $totalEvents = 0;
        $totalGalleryImages = 0;


        /*
        |--------------------------------------------------------------------------
        | Visitor Statistics
        |--------------------------------------------------------------------------
        */

        $todayVisitors = WebsiteVisitor::whereDate(
            'visit_date',
            today()
        )->count();


        $totalVisitors = WebsiteVisitor::count();


        /*
        |--------------------------------------------------------------------------
        | Last 7 Days Visitors
        |--------------------------------------------------------------------------
        */

        $visitorChart = collect(range(6, 0))
            ->map(function ($daysAgo) {

                $date = Carbon::today()->subDays($daysAgo);

                return [
                    'date' => $date->format('d M'),
                    'visitors' => WebsiteVisitor::whereDate(
                        'visit_date',
                        $date
                    )->count(),
                ];
            });


        return view('backend.dashboard', compact(
            'totalNotices',
            'totalNews',
            'totalEvents',
            'totalGalleryImages',
            'todayVisitors',
            'totalVisitors',
            'visitorChart'
        ));
    }
}