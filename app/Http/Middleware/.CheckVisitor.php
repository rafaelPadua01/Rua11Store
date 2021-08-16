<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request){
            $response = new Illuminate\Http\Response('hello word');
            $response->withCookie(cookie('name', 'value', 24*60));
        }
        return $next($request);
    }
}
