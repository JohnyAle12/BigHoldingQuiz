<?php

declare(strict_types=1);

namespace App\Services\Http;

use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class HttpClientException extends HttpException
{
    public static function serverUnavailable(HttpClient $client): self
    {
        $name = class_basename($client);
        return new self(HttpResponse::HTTP_INTERNAL_SERVER_ERROR, "Server for {$name} Unavailable Exception");
    }

    public static function unauthorized(): self
    {
        return new self(HttpResponse::HTTP_UNAUTHORIZED, 'User unauthorized, token incorrect');
    }

    public static function unexpected(Throwable $trace): self
    {
        return new self(
            HttpResponse::HTTP_BAD_GATEWAY,
            'Unexpected error on HTTP request',
            previous: $trace
        );
    }
}
