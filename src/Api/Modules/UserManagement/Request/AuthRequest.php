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
        return new AuthResponse($response);
    }
}
