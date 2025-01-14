<?php

declare(strict_types=1);

namespace Api\Modules\TransactionInitialization\Request;

use Api\RequestHeaderInterface;

class RecurringPaymentsStatusRequestHeader implements RequestHeaderInterface
{
    public function __construct(
        public string $psuIpAddress,
        public string $psuUserAgent
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
}

