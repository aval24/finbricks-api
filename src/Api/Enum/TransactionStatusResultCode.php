<?php

declare(strict_types=1);

namespace Api\Enum;

enum TransactionStatusResultCode: string
{
    case OPENED = 'OPENED'; // The transaction is awaiting payment by the user. You must wait for the next payment status. The result of the payment is uncertain, yet.
    case AUTHORIZED = 'AUTHORIZED'; // Payment confirmed by user. The bank will perform a final check of the payment, including a check of the balance, and will process the payment. The payment will most likely be made.
    case COMPLETED = 'COMPLETED'; // The bank has confirmed that it has processed the transaction, payment is on its way to your account. Transaction processing is almost certain.
    case BOOKED = 'BOOKED'; // The payment has already appeared in the payer's account and is on its way to your account. Transaction processing is almost certain.
    case SETTLED = 'SETTLED'; // The payment has been credited to the payee's account.
    case REJECTED = 'REJECTED'; // The payment was rejected by the user or the payer's bank.
    case CLOSED = 'CLOSED'; // The payment with result code OPENED was closed after 7 days since it’s initiation.

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
