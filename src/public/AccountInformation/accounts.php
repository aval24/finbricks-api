<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';
$config = require __DIR__ . '/../../../src/config/config.php';

use Api\ApiClient;
use Api\Exceptions\ApiException;
use Api\Modules\AccountInformation\Request\AccountsRequest;
use Api\Modules\AccountInformation\Request\AccountsRequestBody;
use Api\Modules\AccountInformation\Request\AccountsRequestHeader;
use Api\Modules\AccountInformation\Response\AccountsResponse;

$apiClient = new ApiClient($config['base_uri']);

try {
    $accountsRequestHeader = new AccountsRequestHeader();
    $accountsRequestBody = new AccountsRequestBody(
        paymentProvider: 'MOCK_COBS', //*
        merchantId: $config['merchantId'], //*
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
    );

    $tokenRequest = new AccountsRequest($accountsRequestHeader, $accountsRequestBody);
    $apiResponse = $apiClient->send($tokenRequest);
    var_dump($apiResponse->getStatusCode());

    $tokenResponse = new AccountsResponse($apiResponse);
    var_dump($tokenResponse->clientHasAccounts());
    var_dump($tokenResponse->getClientAccounts());

} catch (InvalidArgumentException|ApiException|Exception $e) {
    var_dump($e->getMessage());
}
