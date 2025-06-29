<?php

declare(strict_types=1);

require __DIR__ . '/../../../vendor/autoload.php';

use Api\ApiClient;
use Api\Config\Config;
use Api\Exceptions\ApiException;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsInitRequest;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsInitRequestBody;
use Api\Modules\TransactionInitialization\Request\RecurringPaymentsInitRequestHeader;
use Api\Modules\TransactionInitialization\Response\RecurringPaymentsInitResponse;
use Api\Utils\Util;

try {
    $config = new Config(
        baseUri: 'https://api.sandbox.finbricks.com',
        merchantId: 'e030db16-00dc-4f6e-9755-c063a1144766',
        key: file_get_contents(__DIR__ . '/../../../src/config/key')
    );

    $utils = new Util($config);
    $apiClient = new ApiClient($config->getBaseUri());

    $header = new RecurringPaymentsInitRequestHeader();
    $body = new RecurringPaymentsInitRequestBody(
        merchantId:  $config->getMerchantId(),
        merchantTransactionId: 'a5764857-ae35-34dc-8f25-a9c9e73aa898',
        amount: '100.5',
        debtorAccountIban: 'GB33BUKB20201555555555',
        creditorAccountIban: 'GB94BARC10201530093459',
        description: 'some_description',
        variableSymbol: 'abc',
        specificSymbol: 'def',
        constantSymbol: 'xyz',
        callbackUrl: 'http://example.com',
        clientId: '64a17eea-cd4c-4717-8831-4ecc38434738',
        operationId: null,
        requestedExecutionDate: \DateTimeImmutable::createFromFormat('Y-m-d', '2025-02-01'), //ISO, YYYY-MM-DD
        interval: 'DAILY',
        intervalDue: 7,
        mode: 'UNTIL_DATE',
        modeDue: 'DUE_DAY_OF_MONTH',
        lastExecutionDate: \DateTimeImmutable::createFromFormat('Y-m-d', '2025-02-01'), //ISO, YYYY-MM-DD,
        maxIterations: 3,
        initiatorName: 'init'
    );

    $request = new RecurringPaymentsInitRequest($header, $body, $utils);
    $apiResponse = $apiClient->send($request);
    var_dump($apiResponse->getStatusCode());

    $response = new RecurringPaymentsInitResponse($apiResponse);
    var_dump($response);

} catch (ApiException $e) {
    var_dump($e->toArray());
} catch (InvalidArgumentException|Exception $e) {
    var_dump($e);
}
