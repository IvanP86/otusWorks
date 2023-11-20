<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCountry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $country = $request->route()->parameter('country');
        if ($country == 'en') {
            App::setLocale('en');
        } else {
            App::setLocale('ru');
        }
        $request->route()->forgetParameter('country');

        return $next($request);
    }
}
