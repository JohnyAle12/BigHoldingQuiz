<?php

declare(strict_types=1);

namespace App\Services\Http;

interface HttpInterface
{
    public function request(string $method, string $uri, array $options = []): array;
}
