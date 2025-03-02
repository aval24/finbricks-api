<?php

namespace Api\Modules\AccountInformation\Response\Dto;

class TransactionResponseDto
{
    public function __construct(
        public ?string $fbxReference,
        public ?string $entryReference,
        public ?string $creditDebitIndicator,
        public ?bool $reversalIndicator,
        public string $status,
        public ?TransactionResponseAmountDto $transactionResponseAmountDto,
        public ?TransactionResponseBookingDateDto $transactionResponseBookingDateDto,
        public ?TransactionResponseValueDateDto $transactionResponseValueDateDto,
        public ?TransactionResponseBankTransactionCodeDto $transactionResponseBankTransactionCodeDto,
    ) {
    }
}
