<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Request;

use Api\RequestBodyInterface;

class TransactionsRequestBody implements RequestBodyInterface
{
    public function __construct(
        protected readonly string $merchantId, //* uuid
        protected readonly string $paymentProvider, //KB
        protected readonly string $bankAccountId, //y3FeaZyvItso-clhpV18X60orMVgulFdBx7
        protected readonly ?string $operationId, //
        protected readonly ?string $clientId, //<=100 chars
        protected readonly ?string $dateFrom,
        protected readonly ?string $dateTo,
        protected readonly ?string $currency,
        protected readonly ?int $size,
        protected readonly ?string $cursor,

    ) {
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
            'dateFrom' => $this->dateFrom,
            'dateTo' => $this->dateTo,
            'currency' => $this->currency,
            'size' => $this->size,
            'cursor' => $this->cursor,
        ], fn ($value) => $value !== null);
    }
}
