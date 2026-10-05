<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$permissions
     */
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check if user account is disabled
        if (!$user->status) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'আপনার অ্যাকাউন্টটি সাময়িকভাবে নিষ্ক্রিয় (Inactive) করা হয়েছে। কর্তৃপক্ষের সাথে যোগাযোগ করুন।'
            ]);
        }

        // Super Admin always passes
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Check if user has at least one of the required permissions
        foreach ($permissions as $permission) {
            if ($user->hasPermission($permission)) {
                return $next($request);
            }
        }

        abort(403, 'আপনার এই মডিউলে প্রবেশের অনুমতি নেই (Unauthorized Access)।');
    }
}
