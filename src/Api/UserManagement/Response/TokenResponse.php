<?php

namespace Api\UserManagement\Response;

use Api\ApiResponse;
use Api\ApiResponseInterface;

class TokenResponse extends ApiResponse implements ApiResponseInterface
{
    public function dump()
    {
        var_dump($this->getData());
    }
}