<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';

use Api\ApiClient;
use Api\Config\Config;
use Api\Exceptions\ApiException;
use Api\Modules\Status\Request\BankInfoRequest;
use Api\Modules\Status\Request\BankInfoRequestBody;
use Api\Modules\Status\Request\BankInfoRequestHeader;
use Api\Modules\Status\Response\BankInfoResponse;
use Api\Utils\Util;

try {
    $config = new Config(
        baseUri: 'https://api.sandbox.finbricks.com',
        merchantId: 'e030db16-00dc-4f6e-9755-c063a1144766',
        key: file_get_contents(__DIR__ . '/../../../src/config/key')
    );

    $utils = new Util($config);
    $apiClient = new ApiClient($config->getBaseUri());

    $requestHeader = new BankInfoRequestHeader();
    $requestBody = new BankInfoRequestBody(
        merchantId: $config->getMerchantId(), //*
        //countryCode: 'CZ',
        //enabledForMerchant: true,
    );

    $tokenRequest = new BankInfoRequest($requestHeader, $requestBody, $utils);
    $apiResponse = $apiClient->send($tokenRequest);
    var_dump($apiResponse->getStatusCode());

    $response = new BankInfoResponse($apiResponse);
    var_dump($response);

    // {
    // array(11) {...},
    // array(11) {
    //        ["bankName"]=>
    //        string(16) "Revolut Bank UAB"
    //        ["paymentProvider"]=>
    //        string(10) "REVOLUT_LT"
    //        ["bankCode"]=>
    //        string(4) "3250"
    //        ["countryCode"]=>
    //        string(2) "LT"
    //        ["bic"]=>
    //        string(11) "RVUALT2VXXX"
    //        ["enabledForMerchant"]=>
    //        bool(false)
    //        ["domesticInstantPaymentCreditorSupported"]=>
    //        bool(false)
    //        ["domesticInstantPaymentDebtorSupported"]=>
    //        bool(false)
    //        ["sepaInstantPaymentDebtorSupported"]=>
    //        bool(false)
    //        ["sepaInstantPaymentCreditorSupported"]=>
    //        bool(false)
    //        ["logoUrl"]=>
    //        string(71) "https://cdn.sandbox.finbricks.com/logos/banks/revolut_lt/revolut_lt.svg"
    //      }
    // }

} catch (ApiException $e) {
    var_dump($e->toArray());
} catch (InvalidArgumentException|Exception $e) {
    var_dump($e);
}
