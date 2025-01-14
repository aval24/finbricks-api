<?php

namespace Api\Modules\TransactionInitialization\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

class RecurringPaymentsInitResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse){}
}