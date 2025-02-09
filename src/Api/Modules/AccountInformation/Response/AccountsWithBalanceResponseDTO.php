<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response;

readonly class AccountsWithBalanceResponseDTO
{
    public function __construct(
        private string $id,
        private string $accountName,
        private string $productName,
        private float $balance,
        private string $currency,
        private string $balanceType,
        private string $creditDebitIndicator,
        private bool $pispSuitable,
        private array $ownersNames
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccountName(): string
    {
        return $this->accountName;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getBalanceType(): string
    {
        return $this->balanceType;
    }

    public function getCreditDebitIndicator(): string
    {
        return $this->creditDebitIndicator;
    }

    public function isPispSuitable(): bool
    {
        return $this->pispSuitable;
    }

    public function getOwnersNames(): array
    {
        return $this->ownersNames;
    }
}
