<?php

declare(strict_types=1);

use Tests\TestCase;

if (function_exists('pest')) {
    pest()->extend(TestCase::class)->in(__DIR__);
}
