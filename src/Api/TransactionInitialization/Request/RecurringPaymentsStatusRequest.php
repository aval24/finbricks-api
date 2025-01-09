<?php

namespace Api\TransactionInitialization\Request;

use Api\ApiRequest;
use Api\ApiRequestInterface;
use Api\ApiResponseInterface;
use Psr\Http\Message\ResponseInterface;
use Api\TransactionInitialization\Response\RecurringPaymentsStatusResponse;

class RecurringPaymentsStatusRequest extends ApiRequest implements ApiRequestInterface
{
    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct('');
    }

    public function getResponseInstance(ResponseInterface $response): ApiResponseInterface
    {
        return new RecurringPaymentsStatusResponse($response);
    }
}
