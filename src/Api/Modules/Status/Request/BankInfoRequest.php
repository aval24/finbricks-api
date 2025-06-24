<?php

namespace Api\Modules\Status\Request;

use Api\ApiRequest;
use Api\ApiResponseInterface;
use Api\Modules\Status\Response\BankInfoResponse;
use Api\RequestBodyInterface;
use Api\RequestHeaderInterface;
use Api\ResponseInterface;
use Api\Utils\Util;

class BankInfoRequest extends ApiRequest
{
    protected string $endpoint = '/status/bankInfo';
    protected string $method = 'GET';

    public function __construct(
        RequestHeaderInterface $requestHeader,
        RequestBodyInterface $requestBody,
        Util $util
    ) {
        parent::__construct($requestHeader, $requestBody, $util);
    }

    /**
     * @param ApiResponseInterface $response
     * @return ResponseInterface
     */
    public function getResponseInstance(ApiResponseInterface $response): ResponseInterface
    {
        return new BankInfoResponse($response);
    }
}
