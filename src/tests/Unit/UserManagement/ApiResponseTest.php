<?php

declare(strict_types=1);

use Api\ApiResponse;
use Api\Exceptions\ApiException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ApiResponseTest extends TestCase
{
    public function testConstructorPopulatesDataFor200StatusCode(): void
    {
        $content = json_encode(['key' => 'value']);
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('getStatusCode')->willReturn(200);
        $responseMock->method('getBody')->willReturn($this->createMockStream($content));

        $apiResponse = new ApiResponse($responseMock);

        $this->assertSame(200, $apiResponse->getStatusCode());
        $this->assertSame(['key' => 'value'], $apiResponse->getData());
    }

    private function createMockStream(string $content): MockObject
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('getContents')->willReturn($content);
        return $stream;
    }
}
