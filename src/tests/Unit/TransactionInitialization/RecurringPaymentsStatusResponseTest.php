<?php

declare(strict_types=1);

use Api\ApiResponseInterface;
use Api\Modules\TransactionInitialization\Response\RecurringPaymentsStatusResponse;
use PHPUnit\Framework\TestCase;

class RecurringPaymentsStatusResponseTest extends TestCase
{
    public function testGetResultCode(): void
    {
        $apiResponseMock = $this->createMock(ApiResponseInterface::class);
        $expectedData = ['resultCode' => 'ACCEPTED'];
        $apiResponseMock->method('getData')->willReturn($expectedData);

        $response = new RecurringPaymentsStatusResponse($apiResponseMock);
        $this->assertSame('ACCEPTED', $response->getResultCode());
    }

    public function testIsFinalBankStatus(): void
    {
        $apiResponseMock = $this->createMock(ApiResponseInterface::class);
        $expectedData = ['finalBankStatus' => true];
        $apiResponseMock->method('getData')->willReturn($expectedData);

        $response = new RecurringPaymentsStatusResponse($apiResponseMock);
        $this->assertTrue($response->isFinalBankStatus());
    }
}
