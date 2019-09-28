<?php

namespace App\Providers;

use App\Helpers\Formatter;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class FormatServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(Formatter::class, function () {
            return new Formatter(App::getLocale());
        });
    }

    public function provides(): array
    {
        return [Formatter::class];
    }
}
