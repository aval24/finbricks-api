<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';

use Api\ApiClient;
use Api\Config\Config;
use Api\Exceptions\ApiException;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsStatusRequest;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsStatusRequestBody;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsStatusRequestHeader;
use Api\Modules\TransactionInitialization\Response\RecurringPaymentsStatusResponse;
use Api\Utils\Util;

$configFile = __DIR__ . '/../../../src/config/config.php';

try {
    $config = new Config($configFile);
    $utils = new Util($config);
    $apiClient = new ApiClient($config->get('base_uri'));

    $header = new RecurringPaymentsStatusRequestHeader();
    $body = new RecurringPaymentsStatusRequestBody(
        merchantId: $config->get('merchantId'), //*
        merchantTransactionId: 'a5764857-ae35-34dc-8f25-a9c9e73aa898',
    );

    $request = new RecurringPaymentsStatusRequest($header, $body, $utils);
    $apiResponse = $apiClient->send($request);
    var_dump($apiResponse->getStatusCode());

    $response = new RecurringPaymentsStatusResponse($apiResponse);
    var_dump($response->getResultCode());
    var_dump($response->isFinalBankStatus());

} catch (ApiException $e) {
    var_dump($e->toArray());
} catch (InvalidArgumentException|Exception $e) {
    var_dump($e);
}