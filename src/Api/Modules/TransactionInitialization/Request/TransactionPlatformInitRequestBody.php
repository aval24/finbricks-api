<?php

declare(strict_types=1);

namespace Api\Modules\TransactionInitialization\Request;

use Api\RequestBodyInterface;

class TransactionPlatformInitRequestBody implements RequestBodyInterface
{
    public function __construct(
        protected string $merchantId, //"c3073b9d-edd0-49f2-a28d-b7ded8ff9a8b"  *
        protected string $merchantTransactionId, //"e284d244-f2ce-4ee6-9ae3-27869cbd8d0f"  *
        protected string $amount, // 372.88 *
        protected string $totalPrice, // 372.88 *
        // Debtor's account number in IBAN format. Can be null only with combination of MBANK Payment provider
        protected ?string $debtorAccountIban, //"CZ5508000000001234567899"
        protected string $creditorAccountIban, //"CZ5508000000001234567891" *
        protected ?string $description, // "Platba za energie",
        protected ?string $variableSymbol, // "0123456789",
        protected ?string $specificSymbol, // "0123456789",
        protected ?string $constantSymbol,  // "0308",
        protected ?string $callbackUrl, // "https://www.example.com/mycallbackurl",
        protected ?string $clientId, // "0000001",
        protected ?string $operationId, // "66c7aa87-fe24-411c-8bf2-6c3b7a73c25c",
        protected ?string $instructionPriority, // "NORM", // NORM, INST
        protected ?string $initiatorName, // "Podnikatel XY",
        protected ?string $paymentProvider, // "TB_SK"
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

        if (empty($this->amount)) {
            throw new \InvalidArgumentException('Amount is required.');
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
            'amount' => $this->amount,
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
