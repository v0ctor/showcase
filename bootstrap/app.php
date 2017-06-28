<?php

/**
 * Bootstrap script.
 */

# Create the application
$app = new Illuminate\Foundation\Application(
	realpath(__DIR__ . '/../')
);

# Bind important interfaces
$app->singleton(
	Illuminate\Contracts\Http\Kernel::class,
	App\Http\Kernel::class
);

$app->singleton(
	Illuminate\Contracts\Console\Kernel::class,
	App\Console\Kernel::class
);

$app->singleton(
	Illuminate\Contracts\Debug\ExceptionHandler::class,
	App\Exceptions\Handler::class
);

# Return the application
return $app;