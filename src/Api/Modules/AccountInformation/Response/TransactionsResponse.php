<?php

namespace Api\Modules\AccountInformation\Response;

use Api\ApiResponseInterface;
use Api\Modules\AccountInformation\Response\Dto\TransactionDtoFactory;
use Api\ResponseInterface;

class TransactionsResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse)
    {
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->apiResponse->getData()['links'] ?? [];
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->apiResponse->getData()['transactions'];
    }
}
