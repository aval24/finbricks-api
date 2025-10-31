<?php

declare(strict_types=1);

use Api\Modules\TransactionInitialization\Request\RecurringPaymentsInitRequestBody;
use PHPUnit\Framework\TestCase;

class RecurringPaymentsInitRequestBodyTest extends TestCase
{
    public function testValidInput(): void
    {
        $requestBody = new RecurringPaymentsInitRequestBody(
            merchantId: '123e4567-e89b-12d3-a456-426614174000',
            merchantTransactionId: '123e4567-e89b-12d3-a456-426614174001',
            amount: '100',
            debtorAccountIban: 'DE89370400440532013000',
            creditorAccountIban: 'DE89370400440532013001',
            description: 'Payment for services',
            variableSymbol: '1234567890',
            specificSymbol: '0987654321',
            constantSymbol: '1234567890',
            callbackUrl: 'https://example.com/callback',
            clientId: 'client_123',
            operationId: '123e4567-e89b-12d3-a456-426614174002',
            requestedExecutionDate: new \DateTimeImmutable('2025-01-15'),
            interval: RecurringPaymentsInitRequestBody::MONTHLY,
            intervalDue: 1,
            mode: RecurringPaymentsInitRequestBody::UNTIL_DATE,
            modeDue: RecurringPaymentsInitRequestBody::DUE_DAY_OF_MONTH,
            lastExecutionDate: new \DateTimeImmutable('2025-12-31'),
            maxIterations: 12,
            initiatorName: 'John Doe'
        );

        $this->assertInstanceOf(RecurringPaymentsInitRequestBody::class, $requestBody);
    }

    public function testMissingMerchantIdThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Merchant ID is required.');

        new RecurringPaymentsInitRequestBody(
            merchantId: '',
            merchantTransactionId: '123e4567-e89b-12d3-a456-426614174001',
            amount: '100',
            debtorAccountIban: 'DE89370400440532013000',
            creditorAccountIban: 'DE89370400440532013001',
            description: 'Payment for services',
            variableSymbol: '1234567890',
            specificSymbol: '0987654321',
            constantSymbol: '1234567890',
            callbackUrl: 'https://example.com/callback',
            clientId: 'client_123',
            operationId: '123e4567-e89b-12d3-a456-426614174002',
            requestedExecutionDate: new \DateTimeImmutable('2025-01-15'),
            interval: RecurringPaymentsInitRequestBody::MONTHLY,
            intervalDue: 1,
            mode: RecurringPaymentsInitRequestBody::UNTIL_DATE,
            modeDue: RecurringPaymentsInitRequestBody::DUE_DAY_OF_MONTH,
            lastExecutionDate: new \DateTimeImmutable('2025-12-31'),
            maxIterations: 12,
            initiatorName: 'John Doe'
        );
    }

    public function testToArray(): void
    {
        $requestBody = new RecurringPaymentsInitRequestBody(
            merchantId: '123e4567-e89b-12d3-a456-426614174000',
            merchantTransactionId: '123e4567-e89b-12d3-a456-426614174001',
            amount: '100',
            debtorAccountIban: 'DE89370400440532013000',
            creditorAccountIban: 'DE89370400440532013001',
            description: 'Payment for services',
            variableSymbol: '1234567890',
            specificSymbol: '0987654321',
            constantSymbol: '1234567890',
            callbackUrl: 'https://example.com/callback',
            clientId: 'client_123',
            operationId: '123e4567-e89b-12d3-a456-426614174002',
            requestedExecutionDate: new \DateTimeImmutable('2025-01-15'),
            interval: RecurringPaymentsInitRequestBody::MONTHLY,
            intervalDue: 1,
            mode: RecurringPaymentsInitRequestBody::UNTIL_DATE,
            modeDue: RecurringPaymentsInitRequestBody::DUE_DAY_OF_MONTH,
            lastExecutionDate: new \DateTimeImmutable('2025-12-31'),
            maxIterations: 12,
            initiatorName: 'John Doe'
        );

        $expectedArray = [
            'merchantId' => '123e4567-e89b-12d3-a456-426614174000',
            'merchantTransactionId' => '123e4567-e89b-12d3-a456-426614174001',
            'amount' => 100.0,
            'debtorAccountIban' => 'DE89370400440532013000',
            'creditorAccountIban' => 'DE89370400440532013001',
            'description' => 'Payment for services',
            'variableSymbol' => '1234567890',
            'specificSymbol' => '0987654321',
            'constantSymbol' => '1234567890',
            'callbackUrl' => 'https://example.com/callback',
            'clientId' => 'client_123',
            'operationId' => '123e4567-e89b-12d3-a456-426614174002',
            'requestedExecutionDate' => new \DateTimeImmutable('2025-01-15'),
            'interval' => RecurringPaymentsInitRequestBody::MONTHLY,
            'intervalDue' => 1,
            'mode' => RecurringPaymentsInitRequestBody::UNTIL_DATE,
            'modeDue' => RecurringPaymentsInitRequestBody::DUE_DAY_OF_MONTH,
            'lastExecutionDate' => new \DateTimeImmutable('2025-12-31'),
            'maxIterations' => 12,
            'initiatorName' => 'John Doe',
        ];

        $this->assertEquals($expectedArray, $requestBody->toArray());
    }
}
