<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response\Dto;

class TransactionDtoFactory
{
    public static function fromArray(array $data): TransactionResponseDto
    {
        $amount = new TransactionResponseAmountDto(
            (string) $data['amount']['value'],
            $data['amount']['currency'],
        );

        $bookingDate = new TransactionResponseBookingDateDto(
            !empty($data['bookingDate']['date']) ? new \DateTime($data['bookingDate']['date']) : null,
        );

        $valueDate = new TransactionResponseValueDateDto(
            new \DateTime($data['valueDate']['date']),
        );

        $bankTransactionCode = new TransactionResponseBankTransactionCodeDto(
            $data['bankTransactionCode']['proprietary'], // => code, issuer
        );

        return new TransactionResponseDto(
            $data['fbxReference']  ?? null,
            $data['entryReference'] ?? null,
            $data['creditDebitIndicator'] ?? null,
            $data['reversalIndicator'] ?? false,
            $data['status'],
            $amount,
            $bookingDate,
            $valueDate,
            $bankTransactionCode,
        );
    }
}
