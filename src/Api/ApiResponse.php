<?php

namespace Api;

use Api\Exceptions\ApiException;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ApiResponse implements ApiResponseInterface
{
    private int $statusCode;
    private ?array $data;

    /**
     * @throws ApiException
     */
    public function __construct(PsrResponseInterface $response)
    {
        $this->statusCode = $response->getStatusCode();
        $this->data = json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
