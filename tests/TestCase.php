<?php

declare(strict_types=1);

namespace Tests;

use Omisai\LaravelViesRest\ViesRestServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ViesRestServiceProvider::class,
        ];
    }
}
