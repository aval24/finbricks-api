<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Request;

use Api\RequestBodyInterface;

class AccountsRequestBody implements RequestBodyInterface
{
    public function __construct(
        public readonly string $paymentProvider, //KB
        public readonly ?string $merchantId, //* uuid
        public readonly ?string $clientId, //<=100 chars
    )
    {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->paymentProvider)) {
            throw new \InvalidArgumentException('Payment Provider is required.');
        }

        if (empty($this->merchantId) && empty($this->clientId)) {
            throw new \InvalidArgumentException('Merchant ID or Client ID is required.');
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'paymentProvider' => $this->paymentProvider,
            'merchantId' => $this->merchantId,
            'clientId' => $this->clientId,
        ], fn($value) => $value !== null);
    }
}
