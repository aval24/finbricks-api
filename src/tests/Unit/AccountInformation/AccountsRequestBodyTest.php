<?php

declare(strict_types=1);

use Api\Modules\AccountInformation\Request\AccountsRequestBody;
use PHPUnit\Framework\TestCase;

class AccountsRequestBodyTest extends TestCase
{
    public function testValidInput(): void
    {
        $requestBody = new AccountsRequestBody('KB', 'some-merchant-id', 'some-client-id');
        $this->assertSame([
            'paymentProvider' => 'KB',
            'merchantId' => 'some-merchant-id',
            'clientId' => 'some-client-id',
        ], $requestBody->toArray());
    }

    public function testMissingPaymentProvider(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Payment Provider is required.');
        new AccountsRequestBody('', 'some-merchant-id', 'some-client-id');
    }

    public function testMissingMerchantIdAndClientId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Merchant ID or Client ID is required.');
        new AccountsRequestBody('KB', null, null);
    }

    public function testMerchantIdOrClientIdProvided(): void
    {
        $requestBody = new AccountsRequestBody('KB', 'some-merchant-id', null);
        $this->assertSame([
            'paymentProvider' => 'KB',
            'merchantId' => 'some-merchant-id',
        ], $requestBody->toArray());

        $requestBody = new AccountsRequestBody('KB', null, 'some-client-id');
        $this->assertSame([
            'paymentProvider' => 'KB',
            'clientId' => 'some-client-id',
        ], $requestBody->toArray());
    }
}
