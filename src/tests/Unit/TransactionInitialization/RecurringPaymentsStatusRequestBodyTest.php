<?php

declare(strict_types=1);

use Api\Modules\TransactionInitialization\Request\RecurringPaymentsStatusRequestBody;
use PHPUnit\Framework\TestCase;

class RecurringPaymentsStatusRequestBodyTest extends TestCase
{
    public function testSuccessfulObjectCreation(): void
    {
        $merchantId = 'valid-merchant-id';
        $merchantTransactionId = 'valid-transaction-id';

        $requestBody = new RecurringPaymentsStatusRequestBody($merchantId, $merchantTransactionId);
        $this->assertInstanceOf(RecurringPaymentsStatusRequestBody::class, $requestBody);
    }

    public function testEmptyMerchantIdThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Merchant ID is required.');

        new RecurringPaymentsStatusRequestBody('', 'valid-transaction-id');
    }

    public function testEmptyMerchantTransactionIdThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Merchant Transaction ID is required.');

        new RecurringPaymentsStatusRequestBody('valid-merchant-id', '');
    }

    public function testToArrayReturnsCorrectData(): void
    {
        $merchantId = 'valid-merchant-id';
        $merchantTransactionId = 'valid-transaction-id';

        $requestBody = new RecurringPaymentsStatusRequestBody($merchantId, $merchantTransactionId);
        $expectedArray = [
            'merchantId' => $merchantId,
            'merchantTransactionId' => $merchantTransactionId,
        ];

        $this->assertSame($expectedArray, $requestBody->toArray());
    }
}
