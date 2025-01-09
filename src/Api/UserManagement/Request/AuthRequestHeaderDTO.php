<?php

declare(strict_types=1);

namespace Api\UserManagement\Request;

class AuthRequestHeaderDTO
{
    public function __construct(
        public readonly string $psuIpAddress,
        public readonly string $psuUserAgent
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (!filter_var($this->psuIpAddress, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException('Invalid IP address.');
        }

        if (empty($this->psuUserAgent)) {
            throw new \InvalidArgumentException('PSU-User-Agent cannot be empty.');
        }
    }

    public function toArray(): array
    {
        return [
            'PSU-IP-Address' => $this->psuIpAddress,
            'PSU-User-Agent' => $this->psuUserAgent,
        ];
    }
}

