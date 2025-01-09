<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';
$config = require __DIR__ . '/../../src/config/config.php';

use Api\Modules\UserManagement\Request\AuthRequest;
use Api\Modules\UserManagement\Request\AuthRequestBody;
use Api\Modules\UserManagement\Request\AuthRequestHeader;
use Api\ApiClient;
use Api\Exceptions\ApiException;
use Api\Modules\UserManagement\Response\AuthResponse;

$apiClient = new ApiClient($config['base_uri']);

try {
    $authRequestHeader = new AuthRequestHeader('192.168.1.1', 'Mozilla/5.0');
    $authRequestBody = new AuthRequestBody(
        merchantId: $config['merchantId'], //*
        //clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
        clientId: null,
        paymentProvider: 'MOCK_COBS', //*
        scope: 'AISP_PISP',
        callbackUrl: 'https://test.com/callback',
        accountIdentifications: [['value' => 'HU42117730161111101800000000', 'type' => 'IBAN']],
        psuId: '81444666'
    );

    $authRequest = new AuthRequest($authRequestHeader, $authRequestBody);
    $apiResponse = $apiClient->send($authRequest);
    var_dump($apiResponse->getStatusCode());

    $authResponse = new AuthResponse($apiResponse);
    var_dump($authResponse->getRedirectUrl());
    var_dump($authResponse->getOperationId());

} catch (InvalidArgumentException|ApiException|Exception $e) {
    var_dump($e->getMessage());
}



