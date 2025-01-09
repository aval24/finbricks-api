<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';
$config = require __DIR__ . '/../../src/config/config.php';

use Api\Modules\UserManagement\Request\TokenRequest;
use Api\Modules\UserManagement\Request\TokenRequestBody;
use Api\Modules\UserManagement\Request\TokenRequestHeader;
use Api\ApiClient;
use Api\Exceptions\ApiException;
use Api\Modules\UserManagement\Response\TokenResponse;

$apiClient = new ApiClient($config['base_uri']);

try {
    $tokenRequestHeader = new TokenRequestHeader('192.168.1.1', 'Mozilla/5.0');
    $tokenRequestBody = new TokenRequestBody(
        merchantId: $config['merchantId'], //*
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
    );

    $tokenRequest = new TokenRequest($tokenRequestHeader, $tokenRequestBody);
    $apiResponse = $apiClient->send($tokenRequest);
    var_dump($apiResponse->getStatusCode());

    $tokenResponse = new TokenResponse($apiResponse);
    var_dump($tokenResponse);

} catch (InvalidArgumentException|ApiException|Exception $e) {
    var_dump($e->getMessage());
}



