<?php

declare(strict_types=1);

namespace Api;

abstract class ApiRequest
{
    protected string $endpoint;
    protected string $method;
    protected array $options;

    public function __construct(string $endpoint, string $method = 'GET', array $options = [])
    {
        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->options = $options;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
