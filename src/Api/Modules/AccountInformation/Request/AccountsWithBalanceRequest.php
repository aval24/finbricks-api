<?php

namespace Api\Modules\AccountInformation\Request;

use Api\ApiRequest;
use Api\ApiResponseInterface;
use Api\Modules\AccountInformation\Response\AccountsWithBalanceResponse;
use Api\RequestBodyInterface;
use Api\RequestHeaderInterface;
use Api\ResponseInterface;
use Api\Utils\Util;

class AccountsWithBalanceRequest extends ApiRequest
{
    protected string $endpoint = '/account/listWithBalance';
    protected string $method = 'GET';

    public function __construct(
        RequestHeaderInterface $tokenRequestHeader,
        RequestBodyInterface $tokenRequestBody,
        Util $util
    ) {
        parent::__construct($tokenRequestHeader, $tokenRequestBody, $util);
    }

    /**
     * @param ApiResponseInterface $response
     * @return ResponseInterface
     */
    public function getResponseInstance(ApiResponseInterface $response): ResponseInterface
    {
        return new AccountsWithBalanceResponse($response);
    }
}
