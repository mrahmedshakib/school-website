<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\News;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\AdmissionApplication;
use App\Models\AdmissionPayment;
use App\Models\VideoGallery;
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
        $totalNews = News::where('is_delete', 0)->count();
        $totalEvents = Event::where('is_delete', 0)->count();
        $totalGalleryImages = Gallery::where('is_delete', 0)->count();
        $totalVideos = VideoGallery::count();

        /*
        |--------------------------------------------------------------------------
        | Academic & Student Statistics
        |--------------------------------------------------------------------------
        */
        $totalTeachers = Teacher::where('is_delete', 0)->count();
        $totalStudents = Student::count();
        $totalApplications = AdmissionApplication::count();
        $pendingApplications = AdmissionApplication::where('status', 'pending')->count();
        $totalPayments = AdmissionPayment::count();

        /*
        |--------------------------------------------------------------------------
        | Visitor Statistics
        |--------------------------------------------------------------------------
        */
        $todayVisitors = WebsiteVisitor::whereDate('visit_date', today())->count();
        $totalVisitors = WebsiteVisitor::count();

        $visitorChart = collect(range(6, 0))
            ->map(function ($daysAgo) {
                $date = Carbon::today()->subDays($daysAgo);
                return [
                    'date' => $date->format('d M'),
                    'visitors' => WebsiteVisitor::whereDate('visit_date', $date)->count(),
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Recent Feeds
        |--------------------------------------------------------------------------
        */
        $recentNotices = Notice::where('is_delete', 0)
            ->latest('notice_date')
            ->limit(5)
            ->get();

        $recentApplications = AdmissionApplication::latest('id')
            ->limit(5)
            ->get();

        return view('backend.dashboard', compact(
            'totalNotices',
            'totalNews',
            'totalEvents',
            'totalGalleryImages',
            'totalVideos',
            'totalTeachers',
            'totalStudents',
            'totalApplications',
            'pendingApplications',
            'totalPayments',
            'todayVisitors',
            'totalVisitors',
            'visitorChart',
            'recentNotices',
            'recentApplications'
        ));
    }
}