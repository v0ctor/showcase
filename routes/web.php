<?php

use App\Helpers\Formatter;
use App\Http\Middleware\SetLanguage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/**
 * Web routes.
 */

# Main
Route::view('', 'main');

# Publications

// WebSocket
Route::redirect('/2015/11/15/coneixent-websocket', '/websocket?hl=ca', 301);
Route::redirect('/2015/11/15/conociendo-websocket', '/websocket?hl=es', 301);

Route::get('websocket', function () {
    if (App::getLocale() === 'en') {
        setlocale(LC_TIME, SetLanguage::SYSTEM_LOCALES['es']);
        App::setLocale('es');
    }

    return view('websocket');
});

// Bitcoin
Route::redirect('/2016/04/13/bitcoin-plantejament-i-protocol', '/bitcoin?hl=ca', 301);
Route::redirect('/2016/04/13/bitcoin-planteamiento-y-protocolo', '/bitcoin?hl=es', 301);

Route::get('bitcoin', function () {
    if (App::getLocale() === 'en') {
        setlocale(LC_TIME, SetLanguage::SYSTEM_LOCALES['es']);
        App::setLocale('es');
    }

    return view('bitcoin', ['formatter' => resolve(Formatter::class)]);
});
