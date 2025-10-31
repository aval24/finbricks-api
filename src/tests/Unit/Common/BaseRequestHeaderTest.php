<?php

use Api\BaseRequestHeader;
use Api\Modules\AccountInformation\Request\AccountsRequestHeader;
use Api\Modules\AccountInformation\Request\AccountsWithBalanceRequestHeader;
use Api\Modules\AccountInformation\Request\TransactionsRequestHeader;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsInitRequestHeader;
use Api\Modules\TransactionInitialization\Request\TransactionPlatformInitRequestHeader;
use Api\Modules\UserManagement\Request\AuthRequestHeader;
use PHPUnit\Framework\TestCase;

class BaseRequestHeaderTest extends TestCase
{
    /**
     * @dataProvider classesDataProvider
     */
    public function testExtendsBaseRequestHeader(string $class): void
    {
        $this->assertTrue(
            is_subclass_of($class, BaseRequestHeader::class),
            sprintf('%s must extend BaseRequestHeader', $class)
        );
    }

    /**
     * @dataProvider classesDataProvider
     */
    public function testValidHeader(string $class): void
    {
        $dto = new $class(
            psuIpAddress: '192.168.1.1',
            psuUserAgent: 'Mozilla/5.0'
        );

        $this->assertEquals('192.168.1.1', $dto->getPsuIpAddress());
        $this->assertEquals('Mozilla/5.0', $dto->getPsuUserAgent());
    }

    /**
     * @dataProvider classesDataProvider
     */
    public function testInvalidIpThrowsException(string $class): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid IP address.');

        new $class(
            psuIpAddress: 'invalid_ip',
            psuUserAgent: 'Mozilla/5.0'
        );
    }

    /**
     * @dataProvider classesDataProvider
     */
    public function testEmptyUserAgentThrowsException(string $class): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('PSU-User-Agent cannot be empty.');

        new $class(
            psuIpAddress: '192.168.1.1',
            psuUserAgent: ''
        );
    }

    /**
     * @dataProvider classesDataProvider
     */
    public function testToArray(string $class): void
    {
        $dto = new $class(
            psuIpAddress: '192.168.1.1',
            psuUserAgent: 'Mozilla/5.0'
        );

        $expectedArray = [
            'PSU-IP-Address' => '192.168.1.1',
            'PSU-User-Agent' => 'Mozilla/5.0',
        ];

        $this->assertEquals($expectedArray, $dto->toArray());
    }

    public static function classesDataProvider(): array
    {
        return [
            AccountsRequestHeader::class => [AccountsRequestHeader::class],
            AccountsWithBalanceRequestHeader::class => [AccountsWithBalanceRequestHeader::class],
            TransactionsRequestHeader::class => [TransactionsRequestHeader::class],
            RecurringPaymentsInitRequestHeader::class => [RecurringPaymentsInitRequestHeader::class],
            TransactionPlatformInitRequestHeader::class => [TransactionPlatformInitRequestHeader::class],
            AuthRequestHeader::class => [AuthRequestHeader::class],
        ];
    }
}