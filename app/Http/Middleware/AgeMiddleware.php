<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AgeMiddleware
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
        if($request->get('') >18){
            return $next($request);
        }

            echo "not 18";
            return response()->view('admin.view');


    }

    public function terminate($request, $response)
    {
        // Store the session data...
    }
}
