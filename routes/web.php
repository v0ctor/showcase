<?php

use App\Helpers\Formatter;
use App\Http\Middleware\SetLanguage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/**
 * Web routes.
 */

# Main
Route::get('', function () {
	return view('main');
});

# Publications

// WebSocket
Route::get('/2015/11/15/coneixent-websocket', function () {
	return redirect('/websocket?hl=ca', 301);
});

Route::get('/2015/11/15/conociendo-websocket', function () {
	return redirect('/websocket?hl=es', 301);
});

Route::get('websocket', function () {
	if (App::getLocale() === 'en') {
		setlocale(LC_TIME, SetLanguage::SYSTEM_LOCALES['es']);
		App::setLocale('es');
	}

	return view('websocket');
});

// Bitcoin
Route::get('/2016/04/13/bitcoin-plantejament-i-protocol', function () {
	return redirect('/bitcoin?hl=ca', 301);
});

Route::get('/2016/04/13/bitcoin-planteamiento-y-protocolo', function () {
	return redirect('/bitcoin?hl=es', 301);
});

Route::get('bitcoin', function () {
	if (App::getLocale() === 'en') {
		setlocale(LC_TIME, SetLanguage::SYSTEM_LOCALES['es']);
		App::setLocale('es');
	}

	return view('bitcoin', ['formatter' => resolve(Formatter::class)]);
});
