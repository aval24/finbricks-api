<?php

declare(strict_types=1);

namespace Api\Modules\UserManagement\Request;

use Api\RequestBodyInterface;

class AuthRequestBody implements RequestBodyInterface
{
    public function __construct(
        public string  $merchantId, //* uuid
        public ?string $clientId, //<=100 chars
        public string  $paymentProvider, //* one of /status/paymentProviders todo
        public ?string $scope, //enum('AISP', 'AISP_PISP')
        public ?string $callbackUrl,
        public ?array  $accountIdentifications, //[] of objects
        public ?string $psuId //* for providers: BRD_RO, RAIFFEISEN_RO, CIB_HU, RAIFFEISEN_HU.
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

        if (!filter_var($this->callbackUrl, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid callback URL.');
        }

        if ($this->clientId !== null && strlen($this->clientId) > 100) {
            throw new \InvalidArgumentException('The length of the Client ID shouldn\'t be more than 100');
        }

        if ($this->scope !== null && !in_array($this->scope, ['AISP', 'AISP_PISP'])) {
            throw new \InvalidArgumentException('The Scope should be one of AISP, AISP_PISP');
        }

        if ($this->psuId === null && in_array($this->paymentProvider, ['BRD_RO', 'RAIFFEISEN_RO', 'CIB_HU', 'RAIFFEISEN_HU'])) {
            throw new \InvalidArgumentException('The Psu ID should be one of AISP, AISP_PISP');
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'accountIdentifications' => $this->accountIdentifications,
            'clientId' => $this->clientId,
            'merchantId' => $this->merchantId,
            'paymentProvider' => $this->paymentProvider,
            'scope' => $this->scope,
            'callbackUrl' => $this->callbackUrl,
            'psuId' => $this->psuId
        ], fn($value) => $value !== null);
    }
}
