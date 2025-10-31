<?php

declare(strict_types=1);

use Api\ApiResponseInterface;
use Api\Modules\UserManagement\Response\AuthResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AuthResponseTest extends TestCase
{
    private ApiResponseInterface|MockObject $apiResponseMock;

    protected function setUp(): void
    {
        $this->apiResponseMock = $this->createMock(ApiResponseInterface::class);
    }

    public function testGetRedirectUrl(): void
    {
        $this->apiResponseMock->method('getData')->willReturn(['redirectUrl' => 'https://example.com']);

        $authResponse = new AuthResponse($this->apiResponseMock);

        $this->assertEquals('https://example.com', $authResponse->getRedirectUrl());
    }

    public function testGetOperationIdWithOperationId(): void
    {
        // Mock the data returned by the ApiResponseInterface with an operationId
        $this->apiResponseMock->method('getData')->willReturn(['operationId' => '12345']);

        $authResponse = new AuthResponse($this->apiResponseMock);

        $this->assertEquals(12345, $authResponse->getOperationId());
    }

    public function testGetOperationIdWithoutOperationId(): void
    {
        // Mock the data returned by the ApiResponseInterface without an operationId
        $this->apiResponseMock->method('getData')->willReturn([]);

        $authResponse = new AuthResponse($this->apiResponseMock);

        $this->assertEquals(null, $authResponse->getOperationId());
    }
}
