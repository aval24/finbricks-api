<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$config = require 'config/config.php';

use Api\ApiClient;
use Api\UserManagement\Request\AuthRequest;
use Api\UserManagement\Request\AuthRequestHeaderDTO;
use Api\UserManagement\Request\AuthRequestBodyDTO;

$apiClient = new ApiClient($config['base_uri']);

try {
    $authRequestHeaderDTO = new AuthRequestHeaderDTO('192.168.1.1', 'Mozilla/5.0');
    $authRequestBodyDTO = new AuthRequestBodyDTO(
        merchantId: $config['merchantId'], //*
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',
        //clientId: null, //operationId returned
        paymentProvider: 'MOCK_COBS', //*
        scope: 'AISP_PISP',
        callbackUrl: 'https://test.com/callback',
        accountIdentifications: [['value' => 'HU42117730161111101800000000', 'type' => 'IBAN']],
        psuId: '81444666'
    );
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . "\n";
    exit;
}

$authRequest = new AuthRequest($authRequestHeaderDTO, $authRequestBodyDTO, $config['key']);
$authResponse = $apiClient->send($authRequest);
echo $authResponse->getStatusCode();
print_r($authResponse->getData());


