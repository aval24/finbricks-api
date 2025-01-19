<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';

use Api\ApiClient;
use Api\Config\Config;
use Api\Exceptions\ApiException;
use Api\Modules\AccountInformation\Request\AccountsWithBalanceRequest;
use Api\Modules\AccountInformation\Request\AccountsWithBalanceRequestBody;
use Api\Modules\AccountInformation\Request\AccountsWithBalanceRequestHeader;
use Api\Modules\AccountInformation\Response\AccountsWithBalanceResponse;
use Api\Utils\Util;

$configFile = __DIR__ . '/../../../src/config/config.php';

try {
    $config = new Config($configFile);
    $utils = new Util($config);
    $apiClient = new ApiClient($config->get('base_uri'));

    $accountsWithBalanceRequestHeader = new AccountsWithBalanceRequestHeader();
    $accountsWithBalanceRequestBody = new AccountsWithBalanceRequestBody(
        paymentProvider: 'MOCK_COBS', //*
        merchantId: $config->get('merchantId'), //*
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
        operationId: '3051932a-fdd2-48fa-b330-7e7d41535969'
    );

    $accountsWithBalanceRequest = new AccountsWithBalanceRequest($accountsWithBalanceRequestHeader, $accountsWithBalanceRequestBody, $utils);
    $apiResponse = $apiClient->send($accountsWithBalanceRequest);
    var_dump($apiResponse->getStatusCode());

    $accountsWithBalanceResponse = new AccountsWithBalanceResponse($apiResponse);
    var_dump($accountsWithBalanceResponse->getAccounts());

} catch (InvalidArgumentException|ApiException|Exception $e) {
    var_dump($e->getMessage());
}
