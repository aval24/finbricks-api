<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';
$config = require __DIR__ . '/../../../src/config/config.php';

use Api\Modules\TransactionInitialization\Request\RecurringPaymentsStatusRequest;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsStatusRequestBody;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsStatusRequestHeader;
use Api\ApiClient;
use Api\Exceptions\ApiException;
use Api\Modules\TransactionInitialization\Response\RecurringPaymentsStatusResponse;

$apiClient = new ApiClient($config['base_uri']);

try {
    $header = new RecurringPaymentsStatusRequestHeader('192.168.1.1', 'Mozilla/5.0');
    $body = new RecurringPaymentsStatusRequestBody(
        merchantId: $config['merchantId'], //*
        //clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
        clientId: null,
        paymentProvider: 'MOCK_COBS', //*
        scope: 'AISP_PISP',
        callbackUrl: 'https://test.com/callback',
        accountIdentifications: [['value' => 'HU42117730161111101800000000', 'type' => 'IBAN']],
        psuId: '81444666'
    );

    $request = new RecurringPaymentsStatusRequest($header, $body);
    $apiResponse = $apiClient->send($request);
    var_dump($apiResponse->getStatusCode());

    $response = new RecurringPaymentsStatusResponse($apiResponse);
    var_dump($response);

} catch (InvalidArgumentException|ApiException|Exception $e) {
    var_dump($e->getMessage());
}




