<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

/**
 * Trim strings middleware.
 */
class TrimStrings extends Middleware
{
	/**
	 * The names of the attributes that should not be trimmed.
	 *
	 * @var array
	 */
	protected $except = [
		'password',
		'password_confirmation',
	];
}
