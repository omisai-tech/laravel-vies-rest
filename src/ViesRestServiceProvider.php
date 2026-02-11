<?php

declare(strict_types=1);

namespace Omisai\LaravelViesRest;

use Illuminate\Support\ServiceProvider;
use Omisai\LaravelViesRest\Http\LaravelHttpClientFactory;
use Omisai\ViesRest\Http\HttpClientFactoryInterface;

class ViesRestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(HttpClientFactoryInterface::class, LaravelHttpClientFactory::class);
    }
}
