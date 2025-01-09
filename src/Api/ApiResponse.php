<?php

namespace Api;

use Psr\Http\Message\ResponseInterface;

class ApiResponse implements ApiResponseInterface
{
    private int $statusCode;
    private array $data;

    public function __construct(ResponseInterface $response)
    {
        $this->statusCode = $response->getStatusCode();
        $this->data = json_decode($response->getBody()->getContents(), true);
        var_dump($this->data);die;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
