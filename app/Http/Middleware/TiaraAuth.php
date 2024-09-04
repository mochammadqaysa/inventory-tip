<?php

namespace App\Http\Middleware;

use App\Helpers\AuthCommon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TiaraAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth = AuthCommon::user();
        if (!isset($auth->username)) {
            return redirect('/');
        }
        return $next($request);
    }
}
