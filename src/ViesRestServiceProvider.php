<?php

declare(strict_types=1);

namespace Omisai\LaravelViesRest;

use Illuminate\Support\ServiceProvider;
use Omisai\LaravelViesRest\Http\LaravelHttpClientFactory;
use Omisai\ViesRest\Http\HttpClientFactoryInterface;
use Omisai\ViesRest\ViesClient;
use Omisai\ViesRest\ViesConfig;

class ViesRestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(HttpClientFactoryInterface::class, LaravelHttpClientFactory::class);

        $this->app->bind(ViesClient::class, function ($app) {
            $config = new ViesConfig;
            $factory = $app->make(HttpClientFactoryInterface::class);

            return new ViesClient($config, $factory);
        });
    }
}
