<?php

declare(strict_types=1);

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

        $key = <<<KEY
        -----BEGIN RSA PRIVATE KEY-----
        MIIBOQIBAAJBAMlPSimPUeI9BvLV0z0MGJESjaJiaoUlth5cDoyzpWKujQ+MwybK
        csJV8kn+iPYmUWmCvIBXkNSBMR2Qw/eccbsCAwEAAQJAP7mz1lgiKaX77x81EVwk
        4rem0kKpSaDYd9/YUz4DGqtqffniulJQ30JZd/uLWxG8NIRhuZKPk/immS79Is2V
        QQIhAPgCyAjF2J/jWVBWy7bxACSLRvZZQudR7T2mjFbgaDvLAiEAz8tjTz4b6YHh
        gDvXo1Gqqd3Og908ewg24LXn1+fow9ECIGRok93hY8uPuugoy78cIUeqT6eLCegn
        JhqQpD7ECc8zAiAefFl6k8MmlA6QcLcnV+DxAQC+aePorQDYIPf9viFxMQIgL0pP
        ruHDTGpHvSMATA8okR7lKlNsRdknC80b/7aJT7g=
        -----END RSA PRIVATE KEY-----
        KEY;

        $configMock = $this->createMock(Api\Config\Config::class);
        $configMock->method('getMerchantId')->willReturn('e030db16-00dc-4f6e-9755-c063a1144766');
        $configMock->method('getKey')->willReturn($key);

        $util = new Util($configMock);

        $request = new AuthRequest(requestHeader: $header, requestBody: $body, util: $util);

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

        $key = <<<KEY
        -----BEGIN RSA PRIVATE KEY-----
        MIIBOQIBAAJBAMlPSimPUeI9BvLV0z0MGJESjaJiaoUlth5cDoyzpWKujQ+MwybK
        csJV8kn+iPYmUWmCvIBXkNSBMR2Qw/eccbsCAwEAAQJAP7mz1lgiKaX77x81EVwk
        4rem0kKpSaDYd9/YUz4DGqtqffniulJQ30JZd/uLWxG8NIRhuZKPk/immS79Is2V
        QQIhAPgCyAjF2J/jWVBWy7bxACSLRvZZQudR7T2mjFbgaDvLAiEAz8tjTz4b6YHh
        gDvXo1Gqqd3Og908ewg24LXn1+fow9ECIGRok93hY8uPuugoy78cIUeqT6eLCegn
        JhqQpD7ECc8zAiAefFl6k8MmlA6QcLcnV+DxAQC+aePorQDYIPf9viFxMQIgL0pP
        ruHDTGpHvSMATA8okR7lKlNsRdknC80b/7aJT7g=
        -----END RSA PRIVATE KEY-----
        KEY;

        $util = new Util(new Api\Config\Config(
            baseUri: 'http://example.com/api',
            merchantId: 'e030db16-00dc-4f6e-9755-c063a1144766',
            key: $key
        ));

        $request = new AuthRequest(
            requestHeader: $header,
            requestBody: $body,
            util: $util
        );

        $mockApiResponse = $this->createMock(Api\ApiResponseInterface::class);

        $response = $request->getResponseInstance($mockApiResponse);

        $this->assertInstanceOf(AuthResponse::class, $response);
    }
}
