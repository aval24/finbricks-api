<?php

namespace Api\UserManagement\Request;

use Api\ApiRequest;
use Api\ApiRequestInterface;
use Api\ApiResponseInterface;
use Psr\Http\Message\ResponseInterface;
use Api\AccountInformation\Response\TokenResponse;

class TokenRequest extends ApiRequest implements ApiRequestInterface
{
    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct('/auth/token');
    }

    public function getResponseInstance(ResponseInterface $response): ApiResponseInterface
    {
        return new TokenResponse($response);
    }
}
