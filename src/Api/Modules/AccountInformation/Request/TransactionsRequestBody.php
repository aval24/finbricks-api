<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Request;

use Api\RequestBodyInterface;

class TransactionsRequestBody implements RequestBodyInterface
{
    public function __construct(
        public readonly string $merchantId, //* uuid
        public readonly string $paymentProvider, //KB
        public readonly string $bankAccountId, //y3FeaZyvItso-clhpV18X60orMVgulFdBx7
        public readonly ?string $operationId, //
        public readonly ?string $clientId, //<=100 chars
    )
    {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->merchantId)) {
            throw new \InvalidArgumentException('Merchant ID is required.');
        }

        if (empty($this->paymentProvider)) {
            throw new \InvalidArgumentException('Payment Provider is required.');
        }

        if (empty($this->bankAccountId)) {
            throw new \InvalidArgumentException('Bank Account ID is required.');
        }

        if (empty($this->operationId) && empty($this->clientId)) {
            throw new \InvalidArgumentException('Operation ID or Client ID is required.');
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'merchantId' => $this->merchantId,
            'paymentProvider' => $this->paymentProvider,
            'bankAccountId' => $this->bankAccountId,
            'operationId' => $this->operationId,
            'clientId' => $this->clientId,
        ], fn($value) => $value !== null);
    }
}
