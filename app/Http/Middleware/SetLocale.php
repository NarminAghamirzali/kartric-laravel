<?php

namespace App\Http\Middleware;

use App\Models\Lang;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $locale = $request->segment(1);  // Get the first segment as the locale
        $languageExists = Lang::where('code', $locale)->exists();

        $supportedLocales = LaravelLocalization::getSupportedLocales();
        $languageSupported = array_key_exists($locale, $supportedLocales);

        // If the locale is valid (exists in the database and supported), set it
        if ($languageExists && $languageSupported) {
            Session::put('locale', $locale);
            LaravelLocalization::setLocale($locale);  // Set the locale for the application
        } else {
            // If the locale is not valid, use the default locale without adding the locale to the URL
            $defaultLocale = LaravelLocalization::getDefaultLocale();

            // If locale is not provided or invalid, avoid adding it to the route
            Session::put('locale', $defaultLocale);
            LaravelLocalization::setLocale($defaultLocale);

            // Redirect to the route without the locale in the URL if not already at the default locale
            if ($locale !== $defaultLocale) {
                return redirect(LaravelLocalization::getNonLocalizedURL());
            }
        }

        return $next($request);
    }

}
