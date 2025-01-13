<?php

declare(strict_types=1);

namespace Tests\Api\Modules\UserManagement\Request;

use Api\Modules\UserManagement\Request\TokenRequest;
use Api\Modules\UserManagement\Request\TokenRequestBody;
use Api\Modules\UserManagement\Request\TokenRequestHeader;
use Api\ApiResponseInterface;
use Api\Modules\UserManagement\Response\TokenResponse;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TokenRequestTest extends TestCase
{
    public function testTokenRequestBodyValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Merchant ID is required.');

        new TokenRequestBody('', 'testClientId');
    }

    public function testTokenRequestBodyValidationClientId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Client ID is required.');

        new TokenRequestBody('testMerchantId', '');
    }

    public function testTokenRequestBodyToArray(): void
    {
        $body = new TokenRequestBody('testMerchantId', 'testClientId');
        $result = $body->toArray();

        $this->assertEquals([
            'merchantId' => 'testMerchantId',
            'clientId' => 'testClientId',
        ], $result);
    }

    public function testGetResponseInstance()
    {
        $header = new TokenRequestHeader();
        $body = new TokenRequestBody('123e4567-e89b-12d3-a456-426614174000', 'TestClientId');
        $tokenRequest = new TokenRequest($header, $body);

        $apiResponseMock = $this->createMock(ApiResponseInterface::class);

        $responseInstance = $tokenRequest->getResponseInstance($apiResponseMock);

        $this->assertInstanceOf(TokenResponse::class, $responseInstance);
    }
}
