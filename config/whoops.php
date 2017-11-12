<?php
/**
 * Whoops configuration.
 */

$env = [
	'APP_KEY',
	'DB_PASSWORD',
];

return [
	'blacklist' => [
		'_ENV'    => $env,
		'_SERVER' => $env,
		'_POST'   => [
			'password',
		],
	],
];
