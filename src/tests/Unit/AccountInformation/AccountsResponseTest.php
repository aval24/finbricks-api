<?php

declare(strict_types=1);

use Api\ApiResponseInterface;
use Api\Modules\AccountInformation\Response\AccountsResponse;
use PHPUnit\Framework\TestCase;

class AccountsResponseTest extends TestCase
{
    public function testClientHasAccountsReturnsTrueWhenAccountsExist(): void
    {
        $apiResponseMock = $this->createMock(ApiResponseInterface::class);
        $apiResponseMock->method('getData')->willReturn(['accounts' => ['account1', 'account2']]);

        $accountsResponse = new AccountsResponse($apiResponseMock);

        $this->assertTrue($accountsResponse->clientHasAccounts());
    }

    public function testClientHasAccountsReturnsFalseWhenNoAccountsExist(): void
    {
        $apiResponseMock = $this->createMock(ApiResponseInterface::class);
        $apiResponseMock->method('getData')->willReturn(['accounts' => []]);

        $accountsResponse = new AccountsResponse($apiResponseMock);

        $this->assertFalse($accountsResponse->clientHasAccounts());
    }

    public function testGetClientAccountsReturnsAccountsArray(): void
    {
        $expectedAccounts = ['account1', 'account2'];
        $apiResponseMock = $this->createMock(ApiResponseInterface::class);
        $apiResponseMock->method('getData')->willReturn(['accounts' => $expectedAccounts]);

        $accountsResponse = new AccountsResponse($apiResponseMock);

        $this->assertSame($expectedAccounts, $accountsResponse->getClientAccounts());
    }
}
