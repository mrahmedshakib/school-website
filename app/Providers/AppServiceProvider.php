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
        View::composer('*', function ($view) {
            $websiteSetting = WebsiteSetting::first();
            $view->with('websiteSetting', $websiteSetting);
        });

        View::composer('frontend.*', function ($view) {
            $latestNotices = Notice::where('status', 1)
                ->where('is_delete', 0)
                ->orderBy('notice_date', 'desc')
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get();

            $view->with('latestNotices', $latestNotices);
        });

        /*
        |--------------------------------------------------------------------------
        | RBAC Gate Definition
        |--------------------------------------------------------------------------
        */
        \Illuminate\Support\Facades\Gate::before(function ($user, $ability) {
            if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
                return true;
            }
            if (method_exists($user, 'hasPermission')) {
                return $user->hasPermission($ability) ?: null;
            }
            return null;
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