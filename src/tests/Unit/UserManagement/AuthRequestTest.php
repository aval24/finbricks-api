<?php

use Api\Modules\UserManagement\Request\AuthRequest;
use Api\Modules\UserManagement\Request\AuthRequestBody;
use Api\Modules\UserManagement\Request\AuthRequestHeader;
use Api\Modules\UserManagement\Response\AuthResponse;
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

        $request = new AuthRequest(
            authRequestHeader: $header,
            authRequestBody: $body,
        );

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

        $request = new AuthRequest(
            authRequestHeader: $header,
            authRequestBody: $body,
        );

        $mockApiResponse = $this->createMock(Api\ApiResponseInterface::class);

        $response = $request->getResponseInstance($mockApiResponse);

        $this->assertInstanceOf(AuthResponse::class, $response);
    }
}
