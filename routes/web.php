<?php

use App\Helpers\Formatter;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\SetLanguage;
use Illuminate\Support\Facades\Route;

/**
 * Web routes.
 */

# Main
Route::get('', function () {
	return view('main');
});

# Publications
Route::get('websocket', function () {
	if (App::getLocale() === 'en') {
		setlocale(LC_TIME, SetLanguage::SYSTEM_LOCALES['es']);
		App::setLocale('es');
	}
	
	return view('websocket');
});

Route::get('bitcoin', function () {
	if (App::getLocale() === 'en') {
		setlocale(LC_TIME, SetLanguage::SYSTEM_LOCALES['es']);
		App::setLocale('es');
	}
	
	return view('bitcoin', ['formatter' => resolve(Formatter::class)]);
});