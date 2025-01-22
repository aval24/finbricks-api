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

$configFile = __DIR__ . '/../../../src/config/config.php';

try {
    $config = new Config($configFile);
    $utils = new Util($config);
    $apiClient = new ApiClient($config->get('base_uri'));

    $tokenRequestHeader = new TokenRequestHeader();
    $tokenRequestBody = new TokenRequestBody(
        merchantId: $config->get('merchantId'), //*
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',//*
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
