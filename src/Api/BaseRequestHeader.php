<?php

namespace Api;

abstract class BaseRequestHeader implements RequestHeaderInterface
{
    public function __construct(
        protected string $psuIpAddress,
        protected string $psuUserAgent
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (! filter_var($this->psuIpAddress, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException('Invalid IP address.');
        }

        if (empty($this->psuUserAgent)) {
            throw new \InvalidArgumentException('PSU-User-Agent cannot be empty.');
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'PSU-IP-Address' => $this->psuIpAddress,
            'PSU-User-Agent' => $this->psuUserAgent,
        ];
    }

    public function getPsuIpAddress(): string
    {
        return $this->psuIpAddress;
    }

    public function getPsuUserAgent(): string
    {
        return $this->psuUserAgent;
    }
}