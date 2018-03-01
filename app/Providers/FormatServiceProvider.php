<?php

namespace App\Providers;

use App\Helpers\Formatter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

/**
 * Format service provider.
 */
class FormatServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Formatter::class, function () {
            return new Formatter(App::getLocale());
        });
    }

    /**
     * {@inheritdoc}
     */
    public function provides(): array
    {
        return [Formatter::class];
    }
}
