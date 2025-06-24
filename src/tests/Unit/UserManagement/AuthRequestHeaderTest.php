<?php

use Api\Modules\UserManagement\Request\AuthRequestHeader;
use PHPUnit\Framework\TestCase;

class AuthRequestHeaderTest extends TestCase
{
    public function testValidHeader(): void
    {
        $dto = new AuthRequestHeader(
            psuIpAddress: '192.168.1.1',
            psuUserAgent: 'Mozilla/5.0'
        );

        $this->assertEquals('192.168.1.1', $dto->getPsuIpAddress());
        $this->assertEquals('Mozilla/5.0', $dto->getPsuUserAgent());
    }

    public function testInvalidIpThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid IP address.');

        new AuthRequestHeader(
            psuIpAddress: 'invalid_ip',
            psuUserAgent: 'Mozilla/5.0'
        );
    }

    public function testEmptyUserAgentThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('PSU-User-Agent cannot be empty.');

        new AuthRequestHeader(
            psuIpAddress: '192.168.1.1',
            psuUserAgent: ''
        );
    }

    public function testToArray(): void
    {
        $dto = new AuthRequestHeader(
            psuIpAddress: '192.168.1.1',
            psuUserAgent: 'Mozilla/5.0'
        );

        $expectedArray = [
            'PSU-IP-Address' => '192.168.1.1',
            'PSU-User-Agent' => 'Mozilla/5.0',
        ];

        $this->assertEquals($expectedArray, $dto->toArray());
    }
}
