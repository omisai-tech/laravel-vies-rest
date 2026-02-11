<?php

declare(strict_types=1);

namespace Omisai\LaravelViesRest\Http;

use Omisai\ViesRest\Contracts\HttpClientInterface;
use Omisai\ViesRest\Http\HttpClientFactoryInterface;

class LaravelHttpClientFactory implements HttpClientFactoryInterface
{
    public function create(string $baseUrl, array $options = []): HttpClientInterface
    {
        return new LaravelHttpClientAdapter($baseUrl, $options);
    }
}
