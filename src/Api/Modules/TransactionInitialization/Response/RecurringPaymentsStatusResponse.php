<?php

namespace Api\Modules\TransactionInitialization\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

class RecurringPaymentsStatusResponse implements ResponseInterface
{
    public const string IN_PROGRESS = 'IN_PROGRESS';
    public const string ACCEPTED = 'ACCEPTED';
    public const string REJECTED = 'REJECTED';

    public static array $resultCodes = [
        self::IN_PROGRESS,
        self::ACCEPTED,
        self::REJECTED,
    ];

    public function __construct(protected ApiResponseInterface $apiResponse)
    {
    }

    /**
     * @return string
     */
    public function getResultCode(): string
    {
        return $this->apiResponse->getData()['resultCode'];
    }

    /**
     * @return bool
     */
    public function isFinalBankStatus(): bool
    {
        return $this->apiResponse->getData()['finalBankStatus'];
    }
}
