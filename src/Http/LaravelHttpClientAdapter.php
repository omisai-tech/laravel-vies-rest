<?php

declare(strict_types=1);

namespace Omisai\LaravelViesRest\Http;

use Illuminate\Http\Client\PendingRequest;
use Omisai\ViesRest\Contracts\HttpClientInterface;
use Omisai\ViesRest\Exceptions\ViesApiException;

class LaravelHttpClientAdapter implements HttpClientInterface
{
    /** @param array<string, mixed> $options */
    public function __construct(
        private string $baseUrl,
        private array $options = [],
        private ?PendingRequest $client = null,
    ) {}

    public function checkVat(array $payload): array
    {
        return $this->request('POST', 'check-vat-number', $payload);
    }

    public function checkVatTest(array $payload): array
    {
        return $this->request('POST', 'check-vat-test-service', $payload);
    }

    public function checkStatus(): array
    {
        return $this->request('GET', 'check-status');
    }

    /** @param null|array<string, string> $payload */
    private function request(string $method, string $path, ?array $payload = null): array
    {
        if ($this->client === null) {
            $this->client = \Illuminate\Support\Facades\Http::timeout($this->options['timeout'] ?? 30)
                ->retry($this->options['retry'] ?? 3, $this->options['retry_delay'] ?? 100);
        }

        $client = $this->client->baseUrl(rtrim($this->baseUrl, '/').'/');

        try {
            if ($method === 'GET') {
                $response = $client->get($path);
            } elseif ($method === 'POST') {
                $response = $client->post($path, $payload);
            } else {
                throw new \InvalidArgumentException("Unsupported HTTP method: {$method}");
            }
        } catch (\Exception $exception) {
            throw new ViesApiException('Connection error while contacting VIES REST API.', 0, null, null, [], $exception);
        }

        $statusCode = $response->status();
        $body = $response->body();

        if ($statusCode < 200 || $statusCode > 299) {
            throw ViesApiException::fromResponse('Unexpected API response.', $response->toPsrResponse());
        }

        $decoded = json_decode($body, true);
        if (!is_array($decoded)) {
            throw new ViesApiException('Unable to decode API response.', $statusCode, $response->headers(), $body);
        }

        return $decoded;
    }
}
