<?php

use Illuminate\Support\Facades\Route;

/**
 * Web routes.
 */

# Main
Route::get('', function () {
	return view('main');
});