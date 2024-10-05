<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Localization
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

        if ($request->hasHeader('X-locale')) {
            $local = ($request->hasHeader('X-locale')) ? $request->header('X-locale') : 'en';

            if (!in_array($local, ['en', 'ar'])) {
                $local = 'en';
            }
            session()->put('locale', $local);
            App::setLocale($local);
        } else {
            if (in_array($request->segment(1), ['en', 'ar'])) {
                session()->put('locale', $request->segment(1));
            }

            if (session()->has('locale')) {
                App::setlocale(session('locale'));
            }
        }
        return $next($request);
    }
}