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

try {
    $config = new Config(
        baseUri: 'https://api.sandbox.finbricks.com',
        merchantId: 'e030db16-00dc-4f6e-9755-c063a1144766',
        key: file_get_contents(__DIR__ . '/../../../src/config/key')
    );

    $utils = new Util($config);
    $apiClient = new ApiClient($config->getBaseUri());

    $header = new RecurringPaymentsStatusRequestHeader();
    $body = new RecurringPaymentsStatusRequestBody(
        merchantId: $config->getMerchantId(), //*
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
