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

        /*
        |--------------------------------------------------------------------------
        | Bengali Digit Blade Directive
        |--------------------------------------------------------------------------
        */
        \Illuminate\Support\Facades\Blade::directive('bnDigit', function ($expression) {
            return "<?php echo (app()->getLocale() === 'en') ? ({$expression}) : str_replace(['0','1','2','3','4','5','6','7','8','9'], ['০','১','২','৩','৪','৫','৬','৭','৮','৯'], (string)({$expression})); ?>";
        });
    }
}