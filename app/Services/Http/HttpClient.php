<?php

declare(strict_types=1);

namespace App\Services\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Services\Http\HttpClientException;

class HttpClient implements HttpInterface
{
    public function __construct(
        protected Client $http,
    ) {
    }

    public function request(string $method, string $uri, array $options = []): array
    {
        try {
            $response = $this->http->request($method, $uri, array_merge(['http_errors' => true], $options));
            $content = $response->getBody()->getContents();
            $parsedContent = $this->parsedContent($content, true);

            $this->requestLogging(
                'info',
                sprintf('%s request response %s for api %s', get_class($this), $method, $uri)
            );

            return $parsedContent;
        } catch (BadResponseException $exception) {
            $this->requestLogging(
                'error',
                sprintf('%s Unexpected Http request errors in %s for api %s', get_class($this), $method, $uri)
            );
            $this->handleRequestError($exception);
        }
    }

    private function parsedContent(
        string $json,
        ?bool $associative = false,
        int $depth = 512
    ): array
    {
        return json_decode($json, $associative, $depth, JSON_OBJECT_AS_ARRAY) ?? [];
    }

    private function requestLogging(
        string $type,
        string $message,
        array $data = []
    ): void {
        Log::$type($message, $data);
    }

    private function handleRequestError(BadResponseException $exception): void
    {
        throw match ($exception->getResponse()?->getStatusCode()) {
            HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
            HttpResponse::HTTP_SERVICE_UNAVAILABLE => HttpClientException::serverUnavailable($this),
            HttpResponse::HTTP_UNAUTHORIZED => HttpClientException::unauthorized(),
            default => HttpClientException::unexpected($exception),
        };        
    }
}
