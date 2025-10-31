<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Request;

use Api\RequestBodyInterface;

class AccountsWithBalanceRequestBody implements RequestBodyInterface
{
    public function __construct(
        protected readonly string $paymentProvider, //KB
        protected readonly string $merchantId, //* uuid
        protected readonly ?string $clientId = null, //<=100 chars
        protected readonly ?string $operationId = null, //uuid
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->paymentProvider)) {
            throw new \InvalidArgumentException('Payment Provider is required.');
        }

        if (empty($this->merchantId)) {
            throw new \InvalidArgumentException('Merchant ID is required.');
        }

        if (empty($this->clientId) && empty($this->operationId)) {
            throw new \InvalidArgumentException('Client ID or Operation ID is required.');
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
            'operationId' => $this->operationId,
        ], fn ($value) => $value !== null);
    }
}
