<?php

namespace Api\Modules\AccountInformation\Request;

use Api\Modules\AccountInformation\Response\TokenResponse;
use Api\ApiRequest;
use Api\ApiRequestInterface;
use Api\ApiResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

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
