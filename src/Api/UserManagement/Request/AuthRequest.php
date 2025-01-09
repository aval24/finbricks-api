<?php

namespace Api\UserManagement\Request;

use Api\ApiRequest;
use Api\ApiRequestInterface;
use Api\ApiResponseInterface;
use Psr\Http\Message\ResponseInterface;
use Api\UserManagement\Response\AuthResponse;
use Firebase\JWT\JWT;

class AuthRequest extends ApiRequest implements ApiRequestInterface
{
    const string URI = '/v2/auth/authenticate';

    public function __construct(
        AuthRequestHeaderDTO $authRequestHeaderDTO,
        AuthRequestBodyDTO $authRequestBodyDTO,
        public readonly string $key
    )
    {
        parent::__construct(
            self::URI,
            'POST',
            $this->prepareRequest($authRequestHeaderDTO, $authRequestBodyDTO)
        );
    }

    public function getResponseInstance(ResponseInterface $response): ApiResponseInterface
    {
        return new AuthResponse($response);
    }

    private function prepareRequest(
        AuthRequestHeaderDTO $authRequestHeaderDTO,
        AuthRequestBodyDTO $authRequestBodyDTO
    ): array
    {
        $body = $authRequestBodyDTO->toArray();

        $payload = [
            'uri' => self::URI,
            'body' => json_encode($body),
        ];

        $jwt = JWT::encode($payload, $this->key, 'RS256', null, ['kid' => $authRequestBodyDTO->merchantId]);

        $headers = $authRequestHeaderDTO->toArray() + ['JWS-Signature' => $jwt];

        return [
            'headers' => $headers,
            'json' => $body
        ];
    }

}
