<?php

namespace Api\Modules\UserManagement\Request;

use Api\ApiRequest;
use Api\ApiResponseInterface;
use Api\Modules\UserManagement\Response\AuthResponse;
use Api\RequestBodyInterface;
use Api\RequestHeaderInterface;
use Api\ResponseInterface;
use Api\Utils\Util;

class AuthRequest extends ApiRequest
{
    protected string $endpoint = '/v2/auth/authenticate';
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
        return new AuthResponse($response);
    }
}
