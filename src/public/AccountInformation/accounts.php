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

try {
    $config = new Config(
        baseUri: 'https://api.sandbox.finbricks.com',
        merchantId: 'e030db16-00dc-4f6e-9755-c063a1144766',
        key: file_get_contents(__DIR__ . '/../../../src/config/key')
    );

    $utils = new Util($config);
    $apiClient = new ApiClient($config->getBaseUri());

    $accountsRequestHeader = new AccountsRequestHeader();
    $accountsRequestBody = new AccountsRequestBody(
        paymentProvider: 'MOCK_COBS', //*
        merchantId: $config->getMerchantId(), //*
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
    );

    $tokenRequest = new AccountsRequest($accountsRequestHeader, $accountsRequestBody, $utils);
    $apiResponse = $apiClient->send($tokenRequest);
    var_dump($apiResponse->getStatusCode());

    $tokenResponse = new AccountsResponse($apiResponse);
    var_dump($tokenResponse->clientHasAccounts());
    var_dump($tokenResponse->getClientAccounts());

} catch (ApiException $e) {
    var_dump($e->toArray());
} catch (InvalidArgumentException|Exception $e) {
    var_dump($e);
}
