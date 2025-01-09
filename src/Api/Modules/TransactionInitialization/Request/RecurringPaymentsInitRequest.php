<?php

namespace Api\Modules\TransactionInitialization\Request;

use Api\Modules\TransactionInitialization\Response\RecurringPaymentsInitResponse;
use Api\ApiRequest;
use Api\ApiRequestInterface;
use Api\ApiResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class RecurringPaymentsInitRequest extends ApiRequest implements ApiRequestInterface
{
    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct('');
    }

    public function getResponseInstance(ResponseInterface $response): ApiResponseInterface
    {
        return new RecurringPaymentsInitResponse($response);
    }
}
