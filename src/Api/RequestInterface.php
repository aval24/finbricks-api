<?php

declare(strict_types=1);

namespace Api;

interface RequestInterface
{
    public function getMethod(): string;

    public function getParams(): array;
}
