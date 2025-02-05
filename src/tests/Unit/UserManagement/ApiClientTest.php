<?php

declare(strict_types=1);

#namespace Api\tests\Unit\UserManagement;

use Api\ApiClient;
use Api\ApiRequestInterface;
use Api\ApiResponseInterface;
use Api\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ApiClientTest extends TestCase
{
    public function testSendReturnsApiResponseInstance(): void
    {
        $mockHttpClient = $this->createMock(Client::class);
        $mockApiRequest = $this->createMock(ApiRequestInterface::class);
        $mockApiResponse = $this->createMock(ApiResponseInterface::class);

        $mockApiRequest->method('getMethod')->willReturn('GET');
        $mockApiRequest->method('getEndpoint')->willReturn('/endpoint');
        $mockApiRequest->method('getOptions')->willReturn([]);
        $mockApiRequest->method('getApiResponseInstance')->willReturn($mockApiResponse);

        $mockHttpClient->method('request')
            ->with('GET', '/endpoint', [])
            ->willReturn(new Response(200, [], '{"data":"test"}'));

        $apiClient = new ApiClient('https://api.example.com');
        $this->setPrivateProperty($apiClient, 'httpClient', $mockHttpClient);

        $result = $apiClient->send($mockApiRequest);

        $this->assertSame($mockApiResponse, $result);
    }

    public function testSendThrowsApiExceptionOnGuzzleException(): void
    {
        $mockHttpClient = $this->createMock(Client::class);
        $mockApiRequest = $this->createMock(ApiRequestInterface::class);

        $mockApiRequest->method('getMethod')->willReturn('GET');
        $mockApiRequest->method('getEndpoint')->willReturn('/endpoint');
        $mockApiRequest->method('getOptions')->willReturn([]);

        $mockHttpClient->method('request')
            ->with('GET', '/endpoint', [])
            ->willThrowException(new RequestException('Request failed', new Request('GET', '/endpoint')));

        $apiClient = new ApiClient('https://api.example.com');
        $this->setPrivateProperty($apiClient, 'httpClient', $mockHttpClient);

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Request failed');

        $apiClient->send($mockApiRequest);
    }

    public function testSendReturnsApiResponseInstanceOnValidRequest()
    {
        $mockHttpClient = $this->createMock(Client::class);
        $mockApiRequest = $this->createMock(ApiRequestInterface::class);
        $mockApiResponse = $this->createMock(ApiResponseInterface::class);

        $mockApiRequest->method('getMethod')->willReturn('GET');
        $mockApiRequest->method('getEndpoint')->willReturn('/valid-endpoint');
        $mockApiRequest->method('getOptions')->willReturn([]);
        $mockApiRequest->method('getApiResponseInstance')->willReturn($mockApiResponse);

        $mockHttpClient->method('request')
            ->willReturn(new Response(200, [], '{"data":"valid response"}'));

        $apiClient = new ApiClient('https://api.example.com');
        $this->setPrivateProperty($apiClient, 'httpClient', $mockHttpClient);

        $result = $apiClient->send($mockApiRequest);

        $this->assertSame($mockApiResponse, $result);
    }

    public function testSendThrowsApiExceptionOnDifferentGuzzleExceptions()
    {
        $mockHttpClient = $this->createMock(Client::class);
        $mockApiRequest = $this->createMock(ApiRequestInterface::class);

        $mockHttpClient->method('request')
            ->will($this->throwException(new RequestException('Timeout', new Request('GET', 'url'))));

        $apiClient = new ApiClient('https://api.example.com');
        $this->setPrivateProperty($apiClient, 'httpClient', $mockHttpClient);

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Timeout');
        $apiClient->send($mockApiRequest);
    }

    private function setPrivateProperty(object $object, string $property, $value): void
    {
        $reflection = new \ReflectionClass($object);
        $property = $reflection->getProperty($property);
        $property->setValue($object, $value);
    }
}
