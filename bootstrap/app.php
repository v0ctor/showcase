<?php

use App\Console\Kernel as ConsoleKernel;
use App\Exceptions\Handler;
use App\Http\Kernel as HttpKernel;
use Illuminate\Contracts\Console\Kernel as ConsoleKenelContract;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Illuminate\Foundation\Application;

/**
 * Bootstrap script.
 */

# Create the application
$app = new Application(
    realpath(__DIR__ . '/../')
);

# Bind important interfaces
$app->singleton(HttpKernelContract::class, HttpKernel::class);
$app->singleton(ConsoleKenelContract::class, ConsoleKernel::class);
$app->singleton(ExceptionHandler::class, Handler::class);

# Return the application
return $app;
