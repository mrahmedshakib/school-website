<?php

namespace App\Http\Middleware;

use App\Models\WebsiteVisitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackWebsiteVisitor
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | Only track GET requests
        |--------------------------------------------------------------------------
        */

        if ($request->isMethod('GET')) {

            /*
            |--------------------------------------------------------------------------
            | Prevent counting same visitor repeatedly in one session/day
            |--------------------------------------------------------------------------
            */

            $sessionKey = 'website_visitor_tracked_' . now()->format('Y-m-d');

            if (!session()->has($sessionKey)) {

                WebsiteVisitor::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'visit_date' => now()->toDateString(),
                ]);

                session()->put($sessionKey, true);
            }
        }

        return $next($request);
    }
}