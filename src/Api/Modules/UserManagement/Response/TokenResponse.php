<?php

namespace Api\Modules\UserManagement\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

/**
 * The service returns multiple records if there are authentications for different providers (banks) or scopes within one clientId.
 */
class TokenResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse) {}

    /**
     * @return bool
     */
    public function clientHasAuthentications(): bool
    {
        return !empty($this->apiResponse->getData());
    }

    /**
     * @return array
     */
    public function getClientAuthentications(): array
    {
        return $this->apiResponse->getData();
    }
}