<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response;

use Api\ApiResponseInterface;
use Api\Modules\AccountInformation\Response\Dto\AccountDtoFactory;
use Api\ResponseInterface;

class AccountsWithBalanceResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse, protected array $accounts = [])
    {
        $this->accounts = array_map(fn ($item) => AccountDtoFactory::fromArray($item), $this->apiResponse->getData());
    }

    /**
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
}
