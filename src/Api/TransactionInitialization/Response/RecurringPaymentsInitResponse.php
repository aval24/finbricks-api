<?php

namespace Api\TransactionInitialization\Response;

use Api\ApiResponse;
use Api\ApiResponseInterface;

class RecurringPaymentsInitResponse extends ApiResponse implements ApiResponseInterface
{
    public function dump()
    {
        var_dump($this->getData());
    }
}