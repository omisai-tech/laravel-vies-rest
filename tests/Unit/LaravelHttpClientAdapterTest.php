<?php

declare(strict_types=1);

use Omisai\LaravelViesRest\Http\LaravelHttpClientAdapter;
use Omisai\ViesRest\Contracts\HttpClientInterface;

it('implements HttpClientInterface', function (): void {
    $adapter = new LaravelHttpClientAdapter('https://example.com');

    expect($adapter)->toBeInstanceOf(HttpClientInterface::class);
});
