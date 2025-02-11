<?php

namespace Api\Modules\AccountInformation\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

/**
 * User's account transactions
 */
class TransactionsResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse)
    {
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->apiResponse->getData();
    }
}
