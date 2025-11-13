<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LoginSession;
use Illuminate\Support\Facades\Session;

class VerifyOTP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $session = LoginSession::where('session_id', $request->session()->getId())
            ->first();

        if ($session->is_verified == '1'){
            return $next($request);
        }
        if(auth()->user()->email_verification == '0'){
            return $next($request);
        }

        return response('/');
    }
}
