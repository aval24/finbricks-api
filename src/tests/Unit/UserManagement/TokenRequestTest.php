<?php

declare(strict_types=1);

use Api\ApiResponseInterface;
use Api\Config\Config;
use Api\Modules\UserManagement\Request\TokenRequest;
use Api\Modules\UserManagement\Request\TokenRequestBody;
use Api\Modules\UserManagement\Request\TokenRequestHeader;
use Api\Modules\UserManagement\Response\TokenResponse;
use Api\Utils\Util;
use PHPUnit\Framework\TestCase;

class TokenRequestTest extends TestCase
{
    public function testTokenRequestBodyValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Merchant ID is required.');

        new TokenRequestBody('', 'testClientId', null);
    }

    public function testTokenRequestBodyValidationClientId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Client ID is required.');

        new TokenRequestBody('testMerchantId', '', null);
    }

    public function testTokenRequestBodyToArray(): void
    {
        $body = new TokenRequestBody('testMerchantId', 'testClientId', null);
        $result = $body->toArray();

        $this->assertEquals([
            'merchantId' => 'testMerchantId',
            'clientId' => 'testClientId',
        ], $result);
    }

    public function testGetResponseInstance()
    {
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

        $header = new TokenRequestHeader();
        $body = new TokenRequestBody('123e4567-e89b-12d3-a456-426614174000', 'TestClientId', null);
        $util = new Util(new Config('baseUri', 'merchantId', $key));

        $tokenRequest = new TokenRequest($header, $body, $util);

        $apiResponseMock = $this->createMock(ApiResponseInterface::class);

        $responseInstance = $tokenRequest->getResponseInstance($apiResponseMock);

        $this->assertInstanceOf(TokenResponse::class, $responseInstance);
    }
}
