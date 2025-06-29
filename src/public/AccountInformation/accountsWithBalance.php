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

try {
    $config = new Config(
        baseUri: 'https://api.sandbox.finbricks.com',
        merchantId: 'e030db16-00dc-4f6e-9755-c063a1144766',
        key: file_get_contents(__DIR__ . '/../../../src/config/key')
    );

    $utils = new Util($config);
    $apiClient = new ApiClient($config->getBaseUri());

    $accountsWithBalanceRequestHeader = new AccountsWithBalanceRequestHeader();
    $accountsWithBalanceRequestBody = new AccountsWithBalanceRequestBody(
        paymentProvider: 'MOCK_COBS', //*
        merchantId: $config->getMerchantId(), //*
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
        operationId: '3051932a-fdd2-48fa-b330-7e7d41535969'
    );

    $accountsWithBalanceRequest = new AccountsWithBalanceRequest($accountsWithBalanceRequestHeader, $accountsWithBalanceRequestBody, $utils);
    $apiResponse = $apiClient->send($accountsWithBalanceRequest);
    var_dump($apiResponse->getStatusCode());

    $accountsWithBalanceResponse = new AccountsWithBalanceResponse($apiResponse);
    var_dump($accountsWithBalanceResponse->getAccounts());

} catch (ApiException $e) {
    var_dump($e->toArray());
} catch (InvalidArgumentException|Exception $e) {
    var_dump($e);
}
