<?php

namespace Api;

use Psr\Http\Message\ResponseInterface;

interface ApiRequestInterface
{
    public function getEndpoint(): string;

    public function getMethod(): string;

    public function getOptions(): array;

    public function getResponseInstance(ResponseInterface $response): ApiResponseInterface;
}
