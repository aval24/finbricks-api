<?php

declare(strict_types=1);

namespace Api\Modules\UserManagement\Response;

class TokenResponseDTO
{
    public function __construct(
        public string $clientId,
        public string $scope,
        public string $provider,
        public string $validFrom,
        public string $validTo,
        public ?string $stronglyAuthenticatedTo,
    ) {
    }
}
