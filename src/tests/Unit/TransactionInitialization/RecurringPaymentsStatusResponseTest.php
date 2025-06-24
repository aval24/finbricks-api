<?php

declare(strict_types=1);

namespace Api\Modules\TransactionInitialization\Response;

use Api\ApiResponseInterface;
use PHPUnit\Framework\TestCase;

class RecurringPaymentsStatusResponseTest extends TestCase
{
    public function testGetResultCode(): void
    {
        $apiResponseMock = $this->createMock(ApiResponseInterface::class);
        $expectedData = ['resultCode' => RecurringPaymentsStatusResponse::ACCEPTED];
        $apiResponseMock->method('getData')->willReturn($expectedData);

        $response = new RecurringPaymentsStatusResponse($apiResponseMock);
        $this->assertSame(RecurringPaymentsStatusResponse::ACCEPTED, $response->getResultCode());
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
