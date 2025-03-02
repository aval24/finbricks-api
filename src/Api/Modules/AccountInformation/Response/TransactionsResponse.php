<?php

namespace Api\Modules\AccountInformation\Response;

use Api\ApiResponseInterface;
use Api\Modules\AccountInformation\Response\Dto\TransactionDtoFactory;
use Api\ResponseInterface;

class TransactionsResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse, protected array $transactions = [])
    {
        $this->transactions = array_map(
            fn ($item) => TransactionDtoFactory::fromArray($item),
            $this->apiResponse->getData()['transactions']
        );
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
