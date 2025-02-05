<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';

use Api\ApiClient;
use Api\Config\Config;
use Api\Exceptions\ApiException;
use Api\Modules\UserManagement\Request\TokenRequest;
use Api\Modules\UserManagement\Request\TokenRequestBody;
use Api\Modules\UserManagement\Request\TokenRequestHeader;
use Api\Modules\UserManagement\Response\TokenResponse;
use Api\Utils\Util;

try {
    $config = new Config(
        baseUri: 'https://api.sandbox.finbricks.com',
        merchantId: 'e030db16-00dc-4f6e-9755-c063a1144766',
        key: file_get_contents(__DIR__ . '/../../../src/config/key')
    );

    $utils = new Util($config);
    $apiClient = new ApiClient($config->getBaseUri());

    $tokenRequestHeader = new TokenRequestHeader();
    $tokenRequestBody = new TokenRequestBody(
        merchantId: $config->getMerchantId(), //*
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
        provider: null
    );

    $tokenRequest = new TokenRequest($tokenRequestHeader, $tokenRequestBody, $utils);
    $apiResponse = $apiClient->send($tokenRequest);
    var_dump($apiResponse->getStatusCode());

    $tokenResponse = new TokenResponse($apiResponse);
    var_dump($tokenResponse->clientHasAuthentications());
    var_dump($tokenResponse->getClientAuthentications());

} catch (ApiException $e) {
    var_dump($e->toArray());
} catch (InvalidArgumentException|Exception $e) {
    var_dump($e);
}
