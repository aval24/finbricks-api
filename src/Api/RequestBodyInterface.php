<?php

declare(strict_types=1);

namespace Api;

interface RequestBodyInterface
{
    public function toArray(): array;
}
