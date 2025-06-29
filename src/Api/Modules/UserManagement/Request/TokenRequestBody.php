<?php

declare(strict_types=1);

namespace Api\Modules\UserManagement\Request;

use Api\RequestBodyInterface;

class TokenRequestBody implements RequestBodyInterface
{
    public function __construct(
        protected string  $merchantId, //* uuid
        protected ?string $clientId, //<=100 chars
        protected ?string $servicer, //<= 50 characters, KB
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
            'provider' => $this->servicer,
        ], fn ($value) => $value !== null);
    }
}
