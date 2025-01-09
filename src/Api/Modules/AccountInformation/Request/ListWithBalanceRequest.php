<?php

namespace Api\Modules\AccountInformation\Request;

use Api\Modules\AccountInformation\Response\ListWithBalanceResponse;
use Api\ApiRequest;
use Api\ApiRequestInterface;
use Api\ApiResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ListWithBalanceRequest extends ApiRequest implements ApiRequestInterface
{
    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct('');
    }

    public function getResponseInstance(ResponseInterface $response): ApiResponseInterface
    {
        return new ListWithBalanceResponse($response);
    }
}
