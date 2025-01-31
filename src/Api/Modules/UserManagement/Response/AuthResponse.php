<?php

namespace Api\Modules\UserManagement\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

class AuthResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse)
    {
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->apiResponse->getData()['redirectUrl'];
    }

    /**
     * @return ?string
     */
    public function getOperationId(): ?string
    {
        return $this->apiResponse->getData()['operationId'] ?? null;
    }
}
