<?php

namespace Api\Modules\TransactionInitialization\Request;

use Api\ApiRequest;
use Api\ApiResponseInterface;
use Api\Modules\TransactionInitialization\Response\RecurringPaymentsInitResponse;
use Api\RequestBodyInterface;
use Api\RequestHeaderInterface;
use Api\ResponseInterface;
use Api\Utils\Util;

class RecurringPaymentsInitRequest extends ApiRequest
{
    protected string $endpoint = '/recurring-payment/init';
    protected string $method = 'POST';

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
        return new RecurringPaymentsInitResponse($response);
    }
}
