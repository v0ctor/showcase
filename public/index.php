<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

/**
 * Index script.
 */

# Set the start time
define('LARAVEL_START', microtime(true));

# Register the auto loader
require __DIR__ . '/../vendor/autoload.php';

# Bootstrap the framework
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

# Run the application
$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
