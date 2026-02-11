<?php

declare(strict_types=1);

use Omisai\LaravelViesRest\Http\LaravelHttpClientFactory;
use Omisai\ViesRest\Contracts\HttpClientInterface;

it('creates HttpClientInterface instance', function (): void {
    $factory = new LaravelHttpClientFactory;

    $client = $factory->create('https://example.com', ['timeout' => 10]);

    expect($client)->toBeInstanceOf(HttpClientInterface::class);
});
