<?php

declare(strict_types=1);

namespace Api\Modules\TransactionInitialization\Request;

use Api\RequestBodyInterface;

class TransactionPlatformInitRequestBody implements RequestBodyInterface
{
    public function __construct(
        protected string $merchantId, //"c3073b9d-edd0-49f2-a28d-b7ded8ff9a8b"  *
        protected string $merchantTransactionId, //"e284d244-f2ce-4ee6-9ae3-27869cbd8d0f"  *
        protected string $totalPrice, // 372.88 *
        protected string $creditorAccountIban, //"CZ5508000000001234567891" *
        // Debtor's account number in IBAN format. Can be null only with combination of MBANK Payment provider
        protected ?string $debtorAccountIban = null, //"CZ5508000000001234567899"
        protected ?string $description = null, // "Platba za energie",
        protected ?string $variableSymbol = null, // "0123456789",
        protected ?string $specificSymbol = null, // "0123456789",
        protected ?string $constantSymbol = null,  // "0308",
        protected ?string $callbackUrl = null, // "https://www.example.com/mycallbackurl",
        protected ?string $clientId = null, // "0000001",
        protected ?string $operationId = null, // "66c7aa87-fe24-411c-8bf2-6c3b7a73c25c",
        protected ?string $instructionPriority = null, // "NORM", // NORM, INST
        protected ?string $initiatorName = null, // "Podnikatel XY",
        protected ?string $paymentProvider = null, // "TB_SK"
    ) {
        $this->validate();
    }

    /**
     * todo
     * @return void
     */
    private function validate(): void
    {
        if (empty($this->merchantId)) {
            throw new \InvalidArgumentException('Merchant ID is required.');
        }

        if (empty($this->merchantTransactionId)) {
            throw new \InvalidArgumentException('Merchant Transaction ID is required.');
        }

        if (empty($this->totalPrice)) {
            throw new \InvalidArgumentException('TotalPrice is required.');
        }

        if (empty($this->debtorAccountIban)) {
            throw new \InvalidArgumentException('Debtor Account Iban is required.');
        }

        if (empty($this->creditorAccountIban)) {
            throw new \InvalidArgumentException('Creditor Account Iban is required.');
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'merchantId' => $this->merchantId,
            'merchantTransactionId' => $this->merchantTransactionId,
            'totalPrice' => $this->totalPrice,
            'debtorAccountIban' => $this->debtorAccountIban,
            'creditorAccountIban' => $this->creditorAccountIban,
            'description' => $this->description,
            'variableSymbol' => $this->variableSymbol,
            'specificSymbol' => $this->specificSymbol,
            'constantSymbol' => $this->constantSymbol,
            'callbackUrl' => $this->callbackUrl,
            'clientId' => $this->clientId,
            'operationId' => $this->operationId,
            'instructionPriority' => $this->instructionPriority,
            'initiatorName' => $this->initiatorName,
            'paymentProvider' => $this->paymentProvider,
        ], fn ($value) => $value !== null);
    }
}
