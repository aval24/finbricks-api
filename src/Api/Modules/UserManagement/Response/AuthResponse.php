<?php

namespace Api\Modules\UserManagement\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

readonly class AuthResponse implements ResponseInterface
{
    public function __construct(public ApiResponseInterface $apiResponse){}

    /**
     * @return array
     */
    public function getRedirectUrl(): array
    {
        return ['redirectUrl' => $this->apiResponse->getData()['redirectUrl']];
    }

    /**
     * @return array
     */
    public function getOperationId(): array
    {
        return ['operationId' => $this->apiResponse->getData()['operationId'] ?? null];
    }
}