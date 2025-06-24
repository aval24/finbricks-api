<?php

declare(strict_types=1);

namespace Api;

interface RequestHeaderInterface
{
    public function toArray(): array;
}
