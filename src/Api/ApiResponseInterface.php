<?php

declare(strict_types=1);

namespace Api;

interface ApiResponseInterface
{
    public function getStatusCode(): int;

    public function getData(): array;
}
