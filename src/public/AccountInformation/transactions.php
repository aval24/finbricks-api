<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';

use Api\ApiClient;
use Api\Config\Config;
use Api\Exceptions\ApiException;
use Api\Modules\AccountInformation\Request\TransactionsRequest;
use Api\Modules\AccountInformation\Request\TransactionsRequestBody;
use Api\Modules\AccountInformation\Request\TransactionsRequestHeader;
use Api\Modules\AccountInformation\Response\TransactionsResponse;
use Api\Utils\Util;

try {
    $config = new Config(
        baseUri: 'https://api.sandbox.finbricks.com',
        merchantId: 'e030db16-00dc-4f6e-9755-c063a1144766',
        key: file_get_contents(__DIR__ . '/../../../src/config/key')
    );

    $utils = new Util($config);
    $apiClient = new ApiClient($config->getBaseUri());

    $transactionsRequestHeader = new TransactionsRequestHeader();
    $transactionsRequestBody = new TransactionsRequestBody(
        merchantId: $config->getMerchantId(), //*
        paymentProvider: 'MOCK_COBS', //*
        bankAccountId: '10037187', // API payment account identifier from the response to a query on the list of accounts.
        operationId: '3051932a-fdd2-48fa-b330-7e7d41535969',
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',
    );

    $transactionsRequest = new TransactionsRequest($transactionsRequestHeader, $transactionsRequestBody, $utils);
    $apiResponse = $apiClient->send($transactionsRequest);
    var_dump($apiResponse->getStatusCode());

    $transactionsResponse = new TransactionsResponse($apiResponse);
    var_dump($transactionsResponse->getTransactions());

} catch (ApiException $e) {
    var_dump($e->toArray());
} catch (InvalidArgumentException|Exception $e) {
    var_dump($e);
}
