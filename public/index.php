<?php

use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel;

/**
 * Index script.
 */

# Set the start time
define('LARAVEL_START', microtime(true));

# Register the auto loader
require __DIR__ . '/../vendor/autoload.php';

# Bootstrap the framework
$app = require_once __DIR__ . '/../bootstrap/app.php';

# Run the application
$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
	$request = Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
