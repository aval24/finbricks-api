<?php

namespace Api\Modules\AccountInformation\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

/**
 * List of user's accounts
 */
readonly class AccountsWithBalanceResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse)
    {
    }

    /**
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->apiResponse->getData();
    }
}
