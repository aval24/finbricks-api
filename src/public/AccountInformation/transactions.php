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

$configFile = __DIR__ . '/../../../src/config/config.php';

try {
    $config = new Config($configFile);
    $utils = new Util($config);
    $apiClient = new ApiClient($config->get('base_uri'));

    $transactionsRequestHeader = new TransactionsRequestHeader();
    $transactionsRequestBody = new TransactionsRequestBody(
        merchantId: $config->get('merchantId'), //*
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

} catch (InvalidArgumentException|ApiException|Exception $e) {
    var_dump($e->getMessage());
}
