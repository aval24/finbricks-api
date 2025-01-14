<?php

namespace Api\Modules\TransactionInitialization\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

readonly class RecurringPaymentsStatusResponse implements ResponseInterface
{
    public function __construct(public ApiResponseInterface $apiResponse){}
}