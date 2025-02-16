<?php

namespace Api\Modules\UserManagement\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

/**
 * The service returns multiple records if there are authentications for different providers (banks) or scopes within one clientId.
 */
class TokenResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse, public array $authentications = [])
    {
        $this->authentications = array_map(fn ($data) => new TokenResponseDTO(
            clientId: $data['clientId'],
            scope: $data['scope'],
            provider: $data['provider'],
            validFrom: $data['validFrom'],
            validTo: $data['validTo'],
            stronglyAuthenticatedTo: $data['stronglyAuthenticatedTo'] ?? null,
        ), $this->apiResponse->getData());
    }

    /**
     * @return bool
     */
    public function clientHasAuthentications(): bool
    {
        return !empty($this->authentications);
    }

    /**
     * @return array
     */
    public function getClientAuthentications(): array
    {
        return $this->authentications;
    }
}
