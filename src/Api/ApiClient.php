<?php

declare(strict_types=1);

namespace Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiClient
{
    private Client $httpClient;
    //private array $config;

    public function __construct(string $baseUri)
    {
        $this->httpClient = new Client(['base_uri' => $baseUri]);
        //$this->config = $config;
    }

    public function send(ApiRequestInterface $apiRequest): ?ApiResponseInterface
    {
        try {
                //print_r($apiRequest->getOptions());die;
                $response = $this->httpClient->request(
                $apiRequest->getMethod(),
                $apiRequest->getEndpoint(),
                $apiRequest->getOptions()
            );
            return $apiRequest->getResponseInstance($response);
        } catch (GuzzleException $e) {
            //var_dump(__FILE__, __LINE__);
            throw new \Exception($e->getMessage());
        }
    }
}
