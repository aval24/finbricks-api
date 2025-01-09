<?php

namespace Api\AccountInformation\Response;

use Api\ApiResponse;
use Api\ApiResponseInterface;

class TransactionsResponse extends ApiResponse implements ApiResponseInterface
{
    public function dump()
    {
        var_dump($this->getData());
    }
}