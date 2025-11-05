<?php

declare(strict_types=1);

namespace Api;

use Api\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ApiClient
{
    private Client $httpClient;
    private LoggerInterface $logger;

    public function __construct(string $baseUri, ?LoggerInterface $logger = null)
    {
        $this->httpClient = new Client(['base_uri' => $baseUri]);
        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * @param ApiRequestInterface $apiRequest
     * @return ApiResponseInterface
     * @throws ApiException
     */
    public function send(ApiRequestInterface $apiRequest): ApiResponseInterface
    {
        try {
            $response = $this->httpClient->request(
                $apiRequest->getMethod(),
                $apiRequest->getEndpoint(),
                $apiRequest->getOptions()
            );

            $apiResponse = $apiRequest->getApiResponseInstance($response);

            $this->logSuccess($apiRequest, $apiResponse);

            return $apiResponse;

        } catch (GuzzleException $e) {

            if (false === method_exists($e, 'getResponse') || $e->getResponse() === null) {
                $exception = new ApiException('No response', 0, 500);
            } else {
                $responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);

                $code    = $responseBody['code'] ?? 'Code not found';
                $message = $responseBody['message'] ?? 'Message not found';

                $exception = new ApiException($message, $code, $e->getCode());
            }

            $this->logError($apiRequest, $exception);

            throw $exception;
        }
    }

    private function logSuccess(ApiRequestInterface $apiRequest, ApiResponseInterface $apiResponse): void
    {
        $this->logger->info('API request and response', [
            'request_uri' => $apiRequest->getEndpoint(),
            'request_method' => $apiRequest->getMethod(),
            'status_code' => $apiResponse->getStatusCode(),
            'headers' => $apiRequest->getOptions()['headers'] ?? [],
            'request' => match ($apiRequest->getMethod()) {
                'POST' => $apiRequest->getOptions()['json'] ?? null,
                'GET' => $apiRequest->getOptions()['query'] ?? null,
                default => null,
            },
            'response' => $apiResponse->getData(),
        ]);
    }

    private function logError(ApiRequestInterface $apiRequest, ApiException $e): void
    {
        $this->logger->info('API request and response', [
            'request_uri' => $apiRequest->getEndpoint(),
            'request_method' => $apiRequest->getMethod(),
            'status_code' => $e->getCode(),
            'headers' => $apiRequest->getOptions()['headers'] ?? [],
            'request' => match ($apiRequest->getMethod()) {
                'POST' => $apiRequest->getOptions()['json'] ?? null,
                'GET' => $apiRequest->getOptions()['query'] ?? null,
                default => null,
            },
            'response' => null,
            'error' => $e->toArray(),
        ]);
    }
}
