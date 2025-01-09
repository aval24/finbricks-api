<?php

namespace Api;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

interface ApiRequestInterface
{
    public function getEndpoint(): string;

    public function getMethod(): string;

    public function getOptions(): array;

    public function getApiResponseInstance(PsrResponseInterface $response): ApiResponseInterface;
}
