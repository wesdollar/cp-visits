<?php

namespace App\Http\Middleware;

use Closure;

class FlushSuccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // $request->session()->forget('success');

        return $response;
    }

    public function terminate($request, $response) {
        $request->session()->forget('success');
    }
}
