<?php

declare(strict_types=1);

namespace Api;

interface ResponseInterface
{
    public function getStatusCode(): int;

    public function getData(): array;
}
