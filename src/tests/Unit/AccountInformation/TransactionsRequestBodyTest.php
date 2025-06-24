<?php

namespace Tests\Unit\Api\Modules\AccountInformation\Request;

use Api\Modules\AccountInformation\Request\TransactionsRequestBody;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TransactionsRequestBodyTest extends TestCase
{
    public function testValidInput(): void
    {
        $requestBody = new TransactionsRequestBody(
            'some-merchant-id',
            'KB',
            'y3FeaZyvItso-clhpV18X60orMVgulFdBx7',
            'some-operation-id',
            'some-client-id'
        );

        $this->assertSame([
            'merchantId' => 'some-merchant-id',
            'paymentProvider' => 'KB',
            'bankAccountId' => 'y3FeaZyvItso-clhpV18X60orMVgulFdBx7',
            'operationId' => 'some-operation-id',
            'clientId' => 'some-client-id',
        ], $requestBody->toArray());
    }

    public function testMissingMerchantId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Merchant ID is required.');

        new TransactionsRequestBody(
            '',
            'KB',
            'y3FeaZyvItso-clhpV18X60orMVgulFdBx7',
            'some-operation-id',
            'some-client-id'
        );
    }

    public function testMissingPaymentProvider(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Payment Provider is required.');

        new TransactionsRequestBody(
            'some-merchant-id',
            '',
            'y3FeaZyvItso-clhpV18X60orMVgulFdBx7',
            'some-operation-id',
            'some-client-id'
        );
    }

    public function testMissingBankAccountId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bank Account ID is required.');

        new TransactionsRequestBody(
            'some-merchant-id',
            'KB',
            '',
            'some-operation-id',
            'some-client-id'
        );
    }

    public function testMissingOperationIdAndClientId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Operation ID or Client ID is required.');

        new TransactionsRequestBody(
            'some-merchant-id',
            'KB',
            'y3FeaZyvItso-clhpV18X60orMVgulFdBx7',
            null,
            null
        );
    }

    public function testOperationIdOrClientIdProvided(): void
    {
        $requestBody = new TransactionsRequestBody(
            'some-merchant-id',
            'KB',
            'y3FeaZyvItso-clhpV18X60orMVgulFdBx7',
            'some-operation-id',
            null
        );

        $this->assertSame([
            'merchantId' => 'some-merchant-id',
            'paymentProvider' => 'KB',
            'bankAccountId' => 'y3FeaZyvItso-clhpV18X60orMVgulFdBx7',
            'operationId' => 'some-operation-id',
        ], $requestBody->toArray());

        $requestBody = new TransactionsRequestBody(
            'some-merchant-id',
            'KB',
            'y3FeaZyvItso-clhpV18X60orMVgulFdBx7',
            null,
            'some-client-id'
        );

        $this->assertSame([
            'merchantId' => 'some-merchant-id',
            'paymentProvider' => 'KB',
            'bankAccountId' => 'y3FeaZyvItso-clhpV18X60orMVgulFdBx7',
            'clientId' => 'some-client-id',
        ], $requestBody->toArray());
    }
}
