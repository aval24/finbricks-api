<?php

declare(strict_types=1);

use Api\Modules\AccountInformation\Request\AccountsWithBalanceRequestBody;
use PHPUnit\Framework\TestCase;

class AccountsWithBalanceRequestBodyTest extends TestCase
{
    public function testValidInput(): void
    {
        $requestBody = new AccountsWithBalanceRequestBody('KB', 'some-merchant-id', 'some-client-id', 'some-operation-id');
        $this->assertSame([
            'paymentProvider' => 'KB',
            'merchantId' => 'some-merchant-id',
            'clientId' => 'some-client-id',
            'operationId' => 'some-operation-id',
        ], $requestBody->toArray());
    }

    public function testMissingPaymentProvider(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Payment Provider is required.');
        new AccountsWithBalanceRequestBody('', 'some-merchant-id', 'some-client-id', 'some-operation-id');
    }

    public function testMissingMerchantId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Merchant ID is required.');
        new AccountsWithBalanceRequestBody('KB', '', 'some-client-id', 'some-operation-id');
    }

    public function testMissingClientIdAndOperationId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Client ID or Operation ID is required.');
        new AccountsWithBalanceRequestBody('KB', 'some-merchant-id', null, null);
    }

    public function testClientIdOrOperationIdProvided(): void
    {
        $requestBody = new AccountsWithBalanceRequestBody('KB', 'some-merchant-id', 'some-client-id', null);
        $this->assertSame([
            'paymentProvider' => 'KB',
            'merchantId' => 'some-merchant-id',
            'clientId' => 'some-client-id',
        ], $requestBody->toArray());

        $requestBody = new AccountsWithBalanceRequestBody('KB', 'some-merchant-id', null, 'some-operation-id');
        $this->assertSame([
            'paymentProvider' => 'KB',
            'merchantId' => 'some-merchant-id',
            'operationId' => 'some-operation-id',
        ], $requestBody->toArray());
    }
}
