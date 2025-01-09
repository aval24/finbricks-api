<?php

namespace Api\UserManagement\Request;

use Api\ApiRequest;
use Api\ApiRequestInterface;
use Api\ApiResponseInterface;
use Psr\Http\Message\ResponseInterface;
use Api\AccountInformation\Response\TransactionsResponse;

class TransactionsRequest extends ApiRequest implements ApiRequestInterface
{
    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct('', 'GET', []);
    }

    public function getResponseInstance(ResponseInterface $response): ApiResponseInterface
    {
        return new TransactionsResponse($response);
    }
}
