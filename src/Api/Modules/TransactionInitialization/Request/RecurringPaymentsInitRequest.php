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
    protected string $endpoint = '/recurringPayments/init';
    protected string $method = 'POST';

    public function __construct(
        RequestHeaderInterface $authRequestHeader,
        RequestBodyInterface $authRequestBody,
        Util $util
    ) {
        parent::__construct(
            $authRequestHeader,
            $authRequestBody,
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
