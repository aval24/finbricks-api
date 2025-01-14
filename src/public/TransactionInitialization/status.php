<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';
$config = require __DIR__ . '/../../../src/config/config.php';

use Api\ApiClient;
use Api\Exceptions\ApiException;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsStatusRequest;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsStatusRequestBody;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsStatusRequestHeader;
use Api\Modules\TransactionInitialization\Response\RecurringPaymentsStatusResponse;

$apiClient = new ApiClient($config['base_uri']);

try {
    $header = new RecurringPaymentsStatusRequestHeader();
    $body = new RecurringPaymentsStatusRequestBody(
        merchantId: $config['merchantId'], //*
        merchantTransactionId: 'a5764857-ae35-34dc-8f25-a9c9e73aa898',
    );

    $request = new RecurringPaymentsStatusRequest($header, $body);
    $apiResponse = $apiClient->send($request);
    var_dump($apiResponse->getStatusCode());

    $response = new RecurringPaymentsStatusResponse($apiResponse);
    var_dump($response->getResultCode());
    var_dump($response->isFinalBankStatus());

} catch (InvalidArgumentException|ApiException|Exception $e) {
    var_dump($e->getMessage());
}
