<?php

namespace Api\Modules\TransactionInitialization\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

class TransactionPlatformInitResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse)
    {
    }

    public function getRedirectUrl(): string
    {
        return $this->apiResponse->getData()['redirectUrl'];
    }
}
