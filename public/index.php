<?php

use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel;

/**
 * Index script.
 */

# Register the auto loader
require __DIR__ . '/../bootstrap/autoload.php';

# Bootstrap the framework
$app = require_once __DIR__ . '/../bootstrap/app.php';

# Run the application
$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
	$request = Request::capture()
);

$response->send();

$kernel->terminate($request, $response);