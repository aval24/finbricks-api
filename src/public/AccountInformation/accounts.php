<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';

use Api\ApiClient;
use Api\Config\Config;
use Api\Exceptions\ApiException;
use Api\Modules\AccountInformation\Request\AccountsRequest;
use Api\Modules\AccountInformation\Request\AccountsRequestBody;
use Api\Modules\AccountInformation\Request\AccountsRequestHeader;
use Api\Modules\AccountInformation\Response\AccountsResponse;
use Api\Utils\Util;

$configFile = __DIR__ . '/../../../src/config/config.php';

try {
    $config = new Config($configFile);
    $utils = new Util($config);
    $apiClient = new ApiClient($config->get('base_uri'));

    $accountsRequestHeader = new AccountsRequestHeader();
    $accountsRequestBody = new AccountsRequestBody(
        paymentProvider: 'MOCK_COBS', //*
        merchantId: $config->get('merchantId'), //*
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
    );

    $tokenRequest = new AccountsRequest($accountsRequestHeader, $accountsRequestBody, $utils);
    $apiResponse = $apiClient->send($tokenRequest);
    var_dump($apiResponse->getStatusCode());

    $tokenResponse = new AccountsResponse($apiResponse);
    var_dump($tokenResponse->clientHasAccounts());
    var_dump($tokenResponse->getClientAccounts());

} catch (InvalidArgumentException|ApiException|Exception $e) {
    var_dump($e->getMessage());
}
