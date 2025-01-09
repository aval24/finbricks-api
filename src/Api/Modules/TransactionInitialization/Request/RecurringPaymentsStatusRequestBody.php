<?php

declare(strict_types=1);

namespace Api\Modules\TransactionInitialization\Request;

use Api\RequestBodyInterface;

class RecurringPaymentsStatusRequestBody implements RequestBodyInterface
{
    public function __construct(
        protected string $merchantId, //* uuid
        protected string $merchantTransactionId //* uuid
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->merchantId)) {
            throw new \InvalidArgumentException('Merchant ID is required.');
        }

        if (empty($this->merchantTransactionId)) {
            throw new \InvalidArgumentException('Merchant Transaction ID is required.');
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'merchantId' => $this->merchantId,
            'merchantTransactionId' => $this->merchantTransactionId,
        ];
    }
}
