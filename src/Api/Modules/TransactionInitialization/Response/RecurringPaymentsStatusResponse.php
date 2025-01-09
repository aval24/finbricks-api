<?php

namespace Api\Modules\TransactionInitialization\Response;

use Api\ApiResponse;
use Api\ApiResponseInterface;

class RecurringPaymentsStatusResponse extends ApiResponse implements ApiResponseInterface
{
    public function dump()
    {
        var_dump($this->getData());
    }
}