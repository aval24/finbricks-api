<?php

namespace Api\Modules\AccountInformation\Request;

use Api\ApiRequest;
use Api\ApiResponseInterface;
use Api\Modules\AccountInformation\Response\TransactionsResponse;
use Api\RequestBodyInterface;
use Api\RequestHeaderInterface;
use Api\ResponseInterface;

class TransactionsRequest extends ApiRequest
{
    protected string $endpoint = '/account/transactions';
    protected string $method = 'GET';

    public function __construct(
        RequestHeaderInterface $transactionsRequestHeader,
        RequestBodyInterface $transactionsRequestBody
    )
    {
        parent::__construct($transactionsRequestHeader, $transactionsRequestBody);
    }

    /**
     * @param ApiResponseInterface $response
     * @return ResponseInterface
     */
    public function getResponseInstance(ApiResponseInterface $response): ResponseInterface
    {
        return new TransactionsResponse($response);
    }
}
