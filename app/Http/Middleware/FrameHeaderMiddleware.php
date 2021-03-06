<?php

namespace App\Http\Middleware;

use Closure;

class FrameHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('X-Frame-Options', 'ALLOW FROM https://help.activatelearning.com/');
        return $response;
    }
}