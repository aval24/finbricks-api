<?php

namespace Tests\Api\Modules\UserManagement\Response;

use Api\ApiResponseInterface;
use Api\Modules\UserManagement\Response\TokenResponse;
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
        $this->apiResponseMock->method('getData')->willReturn([
            [
                'clientId' => 'some-client-id',
                'scope' => 'pay',
                'provider' => 'MOCK',
                'validFrom' => '2020-01-01',
                'validTo' => '2020-01-01',
            ],
        ]);

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
        $data = [
            'clientId' => 'some-client-id',
            'scope' => 'pay',
            'provider' => 'MOCK',
            'validFrom' => '2020-01-01',
            'validTo' => '2021-01-01',
            'stronglyAuthenticatedTo' => '2020-05-01',
        ];

        $this->apiResponseMock->method('getData')->willReturn([$data]);

        $tokenResponse = new TokenResponse($this->apiResponseMock);

        /** @var \Api\Modules\UserManagement\Response\TokenResponseDto $dto */
        $dto = $tokenResponse->getClientAuthentications()[0];

        $this->assertSame($data['clientId'], $dto->clientId);
        $this->assertSame($data['scope'], $dto->scope);
        $this->assertSame($data['provider'], $dto->servicer);
        $this->assertSame($data['validFrom'], $dto->validFrom);
        $this->assertSame($data['validTo'], $dto->validTo);
        $this->assertSame($data['stronglyAuthenticatedTo'], $dto->stronglyAuthenticatedTo);
    }

    public function testGetClientAuthenticationsReturnsEmptyArrayWhenNoData(): void
    {
        $this->apiResponseMock->method('getData')->willReturn([]);

        $tokenResponse = new TokenResponse($this->apiResponseMock);

        $this->assertSame([], $tokenResponse->getClientAuthentications());
    }
}
