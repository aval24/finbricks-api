<?php

use Api\Modules\UserManagement\Request\AuthRequest;
use Api\Modules\UserManagement\Request\AuthRequestBody;
use Api\Modules\UserManagement\Request\AuthRequestHeader;
use Api\Modules\UserManagement\Response\AuthResponse;
use Api\Utils\Util;
use PHPUnit\Framework\TestCase;

class AuthRequestTest extends TestCase
{
    public function testAuthRequestCreation(): void
    {
        $header = new AuthRequestHeader(
            psuIpAddress: '192.168.1.1',
            psuUserAgent: 'Mozilla/5.0'
        );

        $body = new AuthRequestBody(
            merchantId: '1234',
            clientId: null,
            paymentProvider: 'AISP',
            scope: null,
            callbackUrl: 'https://example.com/callback',
            accountIdentifications: null,
            psuId: null
        );

        $configMock = $this->createMock(Api\Config\Config::class);
        $configMock->method('getMerchantId')->willReturn('e030db16-00dc-4f6e-9755-c063a1144766');
        $configMock->method('getKey')->willReturn('key');

        $util = new Util($configMock);

        $request = new AuthRequest(authRequestHeader: $header, authRequestBody: $body, util: $util);

        $this->assertEquals('/v2/auth/authenticate', $request->getEndpoint());
        $this->assertEquals('POST', $request->getMethod());
    }

    public function testGetResponseInstance(): void
    {
        $header = new AuthRequestHeader(
            psuIpAddress: '192.168.1.1',
            psuUserAgent: 'Mozilla/5.0'
        );

        $body = new AuthRequestBody(
            merchantId: 'test_merchant_id',
            clientId: 'client_1',
            paymentProvider: 'AISP',
            scope: 'AISP',
            callbackUrl: 'https://example.com/callback',
            accountIdentifications: [['type' => 'IBAN', 'value' => '123']],
            psuId: 'test_psu_id'
        );

        $util = new Util(new Api\Config\Config(
            baseUri: 'http://example.com/api',
            merchantId: 'e030db16-00dc-4f6e-9755-c063a1144766',
            key: 'some key',
        ));

        $request = new AuthRequest(
            authRequestHeader: $header,
            authRequestBody: $body,
            util: $util
        );

        $mockApiResponse = $this->createMock(Api\ApiResponseInterface::class);

        $response = $request->getResponseInstance($mockApiResponse);

        $this->assertInstanceOf(AuthResponse::class, $response);
    }
}
