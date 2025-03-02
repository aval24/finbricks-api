<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response\Dto;

class TransactionResponseBankTransactionCodeDto
{
    public function __construct(
        public array $proprietary, // => [code, issuer]
    ) {
    }
}
