<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

class AccountsWithBalanceResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse, protected array $accounts = [])
    {
        $this->accounts = array_map(fn ($data) => new AccountsWithBalanceResponseDTO(
            id: $data['id'],
            accountName: $data['accountName'],
            productName: $data['productName'],
            balance: $data['balance'],
            currency: $data['currency'],
            balanceType: $data['balanceType'],
            creditDebitIndicator: $data['creditDebitIndicator'],
            pispSuitable: (bool) $data['pispSuitable'],
            ownersNames: $data['ownersNames']
        ), $this->apiResponse->getData());
    }

    /**
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
}
