<?php

namespace Api\Modules\AccountInformation\Request;

use Api\ApiRequest;
use Api\ApiResponseInterface;
use Api\Modules\AccountInformation\Response\AccountsResponse;
use Api\RequestBodyInterface;
use Api\RequestHeaderInterface;
use Api\ResponseInterface;
use Api\Utils\Util;

class AccountsRequest extends ApiRequest
{
    protected string $endpoint = '/account/list';
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
        return new AccountsResponse($response);
    }
}
