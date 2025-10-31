<?php

namespace Api\Modules\TransactionInitialization\Request;

use Api\ApiRequest;
use Api\ApiResponseInterface;
use Api\Modules\TransactionInitialization\Response\RecurringPaymentsStatusResponse;
use Api\RequestBodyInterface;
use Api\RequestHeaderInterface;
use Api\ResponseInterface;
use Api\Utils\Util;

class RecurringPaymentsStatusRequest extends ApiRequest
{
    protected string $endpoint = '/recurringPayments/status';
    protected string $method = 'GET';

    public function __construct(
        RequestHeaderInterface $requestHeader,
        RequestBodyInterface $requestBody,
        Util $util
    ) {
        parent::__construct(
            $requestHeader,
            $requestBody,
            $util
        );
    }

    /**
     * @param ApiResponseInterface $response
     * @return ResponseInterface
     */
    public function getResponseInstance(ApiResponseInterface $response): ResponseInterface
    {
        return new RecurringPaymentsStatusResponse($response);
    }
}
