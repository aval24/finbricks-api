<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response;

class AccountsWithBalanceResponseDTO
{
    public function __construct(
        public string $id,
        public string $accountName,
        public string $productName,
        public string $balance,
        public string $currency,
        public string $balanceType,
        public string $creditDebitIndicator,
        public bool $pispSuitable,
        public array $ownersNames
    ) {
    }
}
