<?php

namespace Api\Modules\TransactionInitialization\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

class RecurringPaymentsStatusResponse implements ResponseInterface
{
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

    public function getData(): array
    {
        return $this->apiResponse->getData();
    }
}
