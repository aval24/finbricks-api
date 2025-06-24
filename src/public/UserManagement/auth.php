<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';

use Api\ApiClient;
use Api\Config\Config;
use Api\Exceptions\ApiException;
use Api\Modules\UserManagement\Request\AuthRequest;
use Api\Modules\UserManagement\Request\AuthRequestBody;
use Api\Modules\UserManagement\Request\AuthRequestHeader;
use Api\Modules\UserManagement\Response\AuthResponse;
use Api\Utils\Util;

try {
    $config = new Config(
        baseUri: 'https://api.sandbox.finbricks.com',
        merchantId: 'e030db16-00dc-4f6e-9755-c063a1144766',
        key: file_get_contents(__DIR__ . '/../../../src/config/key')
    );

    $utils = new Util($config);
    $apiClient = new ApiClient($config->getBaseUri());

    $authRequestHeader = new AuthRequestHeader('192.168.1.1', 'Mozilla/5.0');
    $authRequestBody = new AuthRequestBody(
        merchantId: $config->getMerchantId(), //*
        //clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
        clientId: null,
        paymentProvider: 'MOCK_COBS', //*
        scope: 'AISP_PISP',
        callbackUrl: 'https://test.com/callback',
        accountIdentifications: [['value' => 'HU42117730161111101800000000', 'type' => 'IBAN']],
        psuId: '81444666'
    );

    $authRequest = new AuthRequest($authRequestHeader, $authRequestBody, $utils);
    $apiResponse = $apiClient->send($authRequest);
    var_dump($apiResponse->getStatusCode());

    $authResponse = new AuthResponse($apiResponse);
    var_dump($authResponse->getRedirectUrl());
    var_dump($authResponse->getOperationId());

} catch (ApiException $e) {
    var_dump($e->toArray());
} catch (InvalidArgumentException|Exception $e) {
    var_dump($e);
}
