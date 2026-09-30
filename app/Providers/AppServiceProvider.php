<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\WebsiteSetting;
use App\Models\Notice;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('frontend.*', function ($view) {

            /*
            |--------------------------------------------------------------------------
            | Website Settings
            |--------------------------------------------------------------------------
            */

            $websiteSetting = WebsiteSetting::first();

            /*
            |--------------------------------------------------------------------------
            | Latest Notices
            |--------------------------------------------------------------------------
            */

            $latestNotices = Notice::where('status', 1)
                ->where('is_delete', 0)
                ->orderBy('notice_date', 'desc')
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get();


            /*
            |--------------------------------------------------------------------------
            | Share Data With Frontend Views
            |--------------------------------------------------------------------------
            */

            $view->with([
                'websiteSetting' => $websiteSetting,
                'latestNotices' => $latestNotices,
            ]);
        });
    }
}