<?php

declare(strict_types=1);

namespace Api;

use Api\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiClient
{
    private Client $httpClient;

    public function __construct(string $baseUri)
    {
        $this->httpClient = new Client(['base_uri' => $baseUri]);
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

            return $apiRequest->getApiResponseInstance($response);

        } catch (GuzzleException $e) {
            throw new ApiException($e->getMessage());
        }
    }
}
