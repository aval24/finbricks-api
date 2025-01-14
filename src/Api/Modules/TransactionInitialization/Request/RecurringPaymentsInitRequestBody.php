<?php

declare(strict_types=1);

namespace Api\Modules\TransactionInitialization\Request;

use Api\RequestBodyInterface;

class RecurringPaymentsInitRequestBody implements RequestBodyInterface
{
    //interval
    public const string DAILY = 'DAILY';          // Once per day
    public const string WEEKLY = 'WEEKLY';        // Once a week
    public const string MONTHLY = 'MONTHLY';      // Once a month
    public const string BI_MONTHLY = 'BI_MONTHLY';// Once every two months
    public const string QUARTERLY = 'QUARTERLY';  // Once every quarter of a year
    public const string HALFYEARLY = 'HALFYEARLY';// Once every six months
    public const string YEARLY = 'YEARLY';        // Once a year
    public const string IRREGULAR = 'IRREGULAR';  // Performed irregularly

    //mode
    public const string UNTIL_DATE = 'UNTIL_DATE'; //recurring payment is valid until specific date
    public const string UNTIL_CANCELLATION = 'UNTIL_CANCELLATION'; //recurring payment is valid forever and must be cancelled by client
    public const string AFTER_MAX_ITERATION_EXCEEDED = 'AFTER_MAX_ITERATION_EXCEEDED'; //certain count of executions is specified
    public const string MAX_AMOUNT_EXCEEDED = 'MAX_AMOUNT_EXCEEDED'; //maximum amount which can be transferred for this order is specified, if next iteration would exceed this amount it is not executed

    //modeDue
    public const string DUE_DAY_OF_MONTH = 'DUE_DAY_OF_MONTH';
    public const string DUE_OR_BEFORE_DAY_OF_MONTH = 'DUE_OR_BEFORE_DAY_OF_MONTH';
    public const string DUE_OR_NEXT_DAY_OF_MONTH = 'DUE_OR_NEXT_DAY_OF_MONTH';
    public const string DUE_LAST_DAY_OF_MONTH = 'DUE_LAST_DAY_OF_MONTH';

    public static array $intervals = [
        self::DAILY,
        self::WEEKLY,
        self::MONTHLY,
        self::BI_MONTHLY,
        self::QUARTERLY,
        self::HALFYEARLY,
        self::YEARLY,
        self::IRREGULAR,
    ];

    public static array $modes = [
        self::UNTIL_DATE,
        self::UNTIL_CANCELLATION,
        self::AFTER_MAX_ITERATION_EXCEEDED,
        self::MAX_AMOUNT_EXCEEDED,
    ];

    public static array $modeDues = [
        self::DUE_DAY_OF_MONTH,
        self::DUE_OR_BEFORE_DAY_OF_MONTH,
        self::DUE_OR_NEXT_DAY_OF_MONTH,
        self::DUE_LAST_DAY_OF_MONTH,
    ];

    public function __construct(
        protected string $merchantId, //* uuid
        protected string $merchantTransactionId, //* uuid
        protected float $amount, //* todo
        protected string $debtorAccountIban, //*
        protected string $creditorAccountIban, //*
        protected ?string $description,    // <= 140 characters
        protected ?string $variableSymbol, // <= 10 characters
        protected ?string $specificSymbol, // <= 10 characters
        protected ?string $constantSymbol, // <= 10 characters
        protected ?string $callbackUrl,
        protected ?string $clientId,       //<=100 chars
        protected ?string $operationId,    //uuid
        protected \DateTimeImmutable $requestedExecutionDate, //* todo check if date
        protected ?string $interval, //*
        //1-7 for WEEKLY interval, 1-28 for MONTHLY, 1-2 for BI_MONTHLY, 1-3 for QUARTERLY, 1-6 for HALFYEARLY, 1-12 for YEARLY
        protected ?int $intervalDue, //todo check ranges
        protected string $mode, //*
        protected string $modeDue, //*
        protected ?\DateTimeImmutable $lastExecutionDate, //todo check if date
        protected ?int $maxIterations,
        protected ?string $initiatorName,
    ) {
        $this->validate();
    }

    /**
     * todo
     * @return void
     */
    private function validate(): void
    {
        if (empty($this->merchantId)) {
            throw new \InvalidArgumentException('Merchant ID is required.');
        }

        if (empty($this->merchantTransactionId)) {
            throw new \InvalidArgumentException('Merchant Transaction ID is required.');
        }

        if (empty($this->amount)) {
            throw new \InvalidArgumentException('Amount is required.');
        }

        if (empty($this->debtorAccountIban)) {
            throw new \InvalidArgumentException('Debtor Account Iban is required.');
        }

        if (empty($this->creditorAccountIban)) {
            throw new \InvalidArgumentException('Creditor Account Iban is required.');
        }

        if (strlen($this->description) > 140) {
            throw new \InvalidArgumentException('Description shouldn\'t be no more than 140 characters.');
        }

        if (strlen($this->variableSymbol) > 10) {
            throw new \InvalidArgumentException('Variable Symbol shouldn\'t be more than 10 characters.');
        }

        if (strlen($this->specificSymbol) > 10) {
            throw new \InvalidArgumentException('Special Symbol shouldn\'t be more than 10 characters.');
        }

        if (strlen($this->constantSymbol) > 10) {
            throw new \InvalidArgumentException('Constant Symbol shouldn\'t be more than 10 characters.');
        }

        if (!filter_var($this->callbackUrl, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid callback URL.');
        }

        if ($this->clientId !== null && strlen($this->clientId) > 100) {
            throw new \InvalidArgumentException('The length of the Client ID shouldn\'t be more than 100');
        }

        if (empty($this->clientId) && empty($this->operationId)) {
            throw new \InvalidArgumentException('Client ID or OperationID is required');
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'merchantId' => $this->merchantId,
            'merchantTransactionId' => $this->merchantTransactionId,
            'amount' => $this->amount,
            'debtorAccountIban' => $this->debtorAccountIban,
            'creditorAccountIban' => $this->creditorAccountIban,
            'description' => $this->description,
            'variableSymbol' => $this->variableSymbol,
            'specificSymbol' => $this->specificSymbol,
            'constantSymbol' => $this->constantSymbol,
            'callbackUrl' => $this->callbackUrl,
            'clientId' => $this->clientId,
            'operationId' => $this->operationId,
            'requestedExecutionDate' => $this->requestedExecutionDate,
            'interval' => $this->interval,
            'intervalDue' => $this->intervalDue,
            'mode' => $this->mode,
            'modeDue' => $this->modeDue,
            'lastExecutionDate' => $this->lastExecutionDate,
            'maxIterations' => $this->maxIterations,
            'initiatorName' => $this->initiatorName
        ], fn($value) => $value !== null);
    }
}
