<?php

use Api\Modules\UserManagement\Request\AuthRequestBody;
use PHPUnit\Framework\TestCase;

class AuthRequestBodyTest extends TestCase
{
    public function testValidRequestBody(): void
    {
        $dto = new AuthRequestBody(
            merchantId: '1234-5678-91011-1213',
            clientId: 'client_1',
            paymentProvider: 'AISP',
            scope: 'AISP',
            callbackUrl: 'https://example.com/callback',
            accountIdentifications: [['type' => 'IBAN', 'value' => '123']],
            psuId: 'test_psu_id'
        );

        $this->assertEquals('1234-5678-91011-1213', $dto->merchantId);
        $this->assertEquals('client_1', $dto->clientId);
        $this->assertEquals('AISP', $dto->paymentProvider);
    }

    public function testEmptyMerchantIdThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Merchant ID is required.');

        new AuthRequestBody(
            merchantId: '',
            clientId: null,
            paymentProvider: 'AISP',
            scope: null,
            callbackUrl: null,
            accountIdentifications: null,
            psuId: null
        );
    }

    public function testInvalidCallbackUrlThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid callback URL.');

        new AuthRequestBody(
            merchantId: '1234',
            clientId: null,
            paymentProvider: 'AISP',
            scope: null,
            callbackUrl: 'not_a_url',
            accountIdentifications: null,
            psuId: null
        );
    }

    public function testToArrayFiltersNullValues(): void
    {
        $dto = new AuthRequestBody(
            merchantId: '1234',
            clientId: null,
            paymentProvider: 'AISP',
            scope: 'AISP',
            callbackUrl: 'https://example.com/callback',
            accountIdentifications: null,
            psuId: null
        );

        $expectedArray = [
            'merchantId' => '1234',
            'paymentProvider' => 'AISP',
            'scope' => 'AISP',
            'callbackUrl' => 'https://example.com/callback',
        ];

        $this->assertEquals($expectedArray, $dto->toArray());
    }
}
