<?php

namespace Tests\Api\Modules\UserManagement\Response;

use Api\Modules\UserManagement\Response\TokenResponse;
use Api\ApiResponseInterface;
use PHPUnit\Framework\TestCase;

class TokenResponseTest extends TestCase
{
    private $apiResponseMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiResponseMock = $this->createMock(ApiResponseInterface::class);
    }

    public function testClientHasAuthenticationsReturnsTrueWhenDataIsNotEmpty(): void
    {
        $this->apiResponseMock->method('getData')->willReturn(['auth1', 'auth2']);

        $tokenResponse = new TokenResponse($this->apiResponseMock);

        $this->assertTrue($tokenResponse->clientHasAuthentications());
    }

    public function testClientHasAuthenticationsReturnsFalseWhenDataIsEmpty(): void
    {
        $this->apiResponseMock->method('getData')->willReturn([]);

        $tokenResponse = new TokenResponse($this->apiResponseMock);

        $this->assertFalse($tokenResponse->clientHasAuthentications());
    }

    public function testGetClientAuthenticationsReturnsDataFromApiResponse(): void
    {
        $data = ['auth1', 'auth2'];
        $this->apiResponseMock->method('getData')->willReturn($data);

        $tokenResponse = new TokenResponse($this->apiResponseMock);

        $this->assertSame($data, $tokenResponse->getClientAuthentications());
    }

    public function testGetClientAuthenticationsReturnsEmptyArrayWhenNoData(): void
    {
        $this->apiResponseMock->method('getData')->willReturn([]);

        $tokenResponse = new TokenResponse($this->apiResponseMock);

        $this->assertSame([], $tokenResponse->getClientAuthentications());
    }
}
