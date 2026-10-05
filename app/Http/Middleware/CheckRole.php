<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->status) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'আপনার অ্যাকাউন্টটি সাময়িকভাবে নিষ্ক্রিয় (Inactive) করা হয়েছে।'
            ]);
        }

        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        if ($user->hasRole($roles)) {
            return $next($request);
        }

        abort(403, 'আপনার নির্ধারিত রোল এই পেজের জন্য প্রযোজ্য নয় (Forbidden Role Access)।');
    }
}
