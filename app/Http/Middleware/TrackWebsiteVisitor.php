<?php

namespace App\Http\Middleware;

use App\Models\WebsiteVisitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackWebsiteVisitor
{
    public function handle(Request $request, Closure $next): Response
    {

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