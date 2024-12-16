<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
{
    /**
     * Desteklenen diller
     */
    protected $languages = ['az', 'en', 'ru'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Header'dan dil bilgisini al
        $locale = $request->header('Accept-Language');

        // Dil belirtilmemişse veya geçersizse varsayılan dili kullan (az)
        if (!$locale || !in_array($locale, $this->languages)) {
            $locale = 'az';
        }

        // Dili app'e set et
        app()->setLocale($locale);

        // Response'a mevcut dili ekle
        $response = $next($request);
        
        if (method_exists($response, 'header')) {
            $response->header('Content-Language', $locale);
        }

        return $response;
    }
}