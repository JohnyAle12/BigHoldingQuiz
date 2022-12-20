<?php

namespace App\ServiceClients;

interface HttpInterface
{
    public function request(string $method, string $uri, array $options = []): array;
}
