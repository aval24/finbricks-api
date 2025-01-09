<?php

namespace Api\Modules\UserManagement\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

readonly class TokenResponse implements ResponseInterface
{
    public function __construct(public ApiResponseInterface $apiResponse){
        var_dump($this->apiResponse);
    }
}