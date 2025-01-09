<?php

namespace Api\Modules\UserManagement\Request;

use Api\ApiRequest;
use Api\ApiResponseInterface;
use Api\Modules\UserManagement\Response\AuthResponse;
use Api\ResponseInterface;

class TokenRequest extends ApiRequest
{
    protected string $endpoint = '/auth/token';
    protected string $method = 'GET';

    public function __construct(
        TokenRequestHeader $tokenRequestHeader,
        TokenRequestBody $tokenRequestBody
    )
    {
        parent::__construct(
            $tokenRequestHeader,
            $tokenRequestBody,
        );
    }

    /**
     * @param ApiResponseInterface $response
     * @return ResponseInterface
     */
    public function getResponseInstance(ApiResponseInterface $response): ResponseInterface
    {
        return new AuthResponse($response);
    }
}
