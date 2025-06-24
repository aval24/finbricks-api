<?php

declare(strict_types=1);

namespace Api\Modules\Status\Request;

use Api\RequestBodyInterface;

class BankInfoRequestBody implements RequestBodyInterface
{
    public function __construct(
        protected readonly ?string $merchantId, //* uuid
        protected readonly ?string $countryCode,
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->merchantId)) {
            throw new \InvalidArgumentException('Merchant ID is required.');
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'merchantId' => $this->merchantId,
            'countryCode' => $this->countryCode,
        ], fn ($value) => $value !== null);
    }
}
