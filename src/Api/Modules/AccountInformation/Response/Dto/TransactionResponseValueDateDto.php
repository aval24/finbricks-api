<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response\Dto;

class TransactionResponseValueDateDto
{
    public function __construct(
        public \DateTimeInterface $date,
    ) {
    }
}
