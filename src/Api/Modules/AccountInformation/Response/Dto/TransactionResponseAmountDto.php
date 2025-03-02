<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response\Dto;

class TransactionResponseAmountDto
{
    public function __construct(
        public string $value,
        public string $currency,
    ) {
    }
}
