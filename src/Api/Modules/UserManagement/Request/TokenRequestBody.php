<?php

declare(strict_types=1);

namespace Api\Modules\UserManagement\Request;

use Api\RequestBodyInterface;

class TokenRequestBody implements RequestBodyInterface
{
    public function __construct(
        public string  $merchantId, //* uuid
        public ?string $clientId, //<=100 chars
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->merchantId)) {
            throw new \InvalidArgumentException('Merchant ID is required.');
        }

        if (empty($this->clientId)) {
            throw new \InvalidArgumentException('Client ID is required.');
        }
  }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'clientId' => $this->clientId,
            'merchantId' => $this->merchantId,
        ], fn($value) => $value !== null);
    }
}
