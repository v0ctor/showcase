<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class SetLanguage
{
    /**
     * Equivalence between ISO 639-1 codes and system locales.
     *
     * @const array
     */
    const SYSTEM_LOCALES = [
        'ca' => 'ca_ES.utf8',
        'en' => 'en_US.utf8',
        'es' => 'es_ES.utf8',
    ];

    /**
     * Languages accepted by the request (ordered by preference).
     *
     * @var array
     * @access protected
     */
    protected $languages = [];

    /**
     * Handle an incoming request.
     *
     * @access public
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Str::startsWith($request->path(), 'api')) {
            $this->init($request);
            $language = $this->getLanguage();
        } else {
            $language = 'en';
        }

        setlocale(LC_TIME, self::SYSTEM_LOCALES[$language]);
        App::setLocale($language);

        return $next($request)->withHeaders([
            'Content-Language' => $language,
            'Vary'             => 'Accept-Language',
        ]);
    }

    /**
     * Return the application language.
     *
     * @access protected
     * @return null|string
     */
    protected function getLanguage(): ?string
    {
        // Return a user preferred language if available
        foreach ($this->languages as $lang) {
            if (in_array($lang, config('app.locales'))) {
                return $lang;
            }
        }

        // Return the fallback locale as a last resort
        return config('app.fallback_locale');
    }

    /**
     * Initialize the languages and fallback languages arrays given a request.
     *
     * @access protected
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function init(Request $request): void
    {
        // Get the language from the "language" cookie, the "Accept-Language" header or the "hl" parameter
        if ($request->hasCookie('language')) {
            $this->addLanguage($request->cookie('language'));
        } elseif ($request->hasHeader('accept-language')) {
            foreach (explode(',', $request->header('accept-language')) as $lang) {
                $this->addLanguage(explode(';', $lang)[0]);
            }
        } elseif ($request->has('hl')) {
            $this->addLanguage($request->input('hl'));
        }

        // Flatten the array
        $this->languages = array_values(array_unique($this->languages));
    }

    /**
     * Add a language to the languages array.
     *
     * @access protected
     * @param string $language
     * @return void
     */
    protected function addLanguage(string $language): void
    {
        $this->languages[] = substr(trim($language), 0, 2);
    }
}
