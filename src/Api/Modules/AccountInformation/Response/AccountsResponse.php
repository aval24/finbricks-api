<?php

namespace Api\Modules\AccountInformation\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

/**
 * List of user's accounts
 */
class AccountsResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse)
    {
    }

    /**
     * @return bool
     */
    public function clientHasAccounts(): bool
    {
        return !empty($this->apiResponse->getData()['accounts']);
    }

    /**
     * @return array
     */
    public function getClientAccounts(): array
    {
        return $this->apiResponse->getData()['accounts'];
    }
}
