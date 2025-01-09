<?php

declare(strict_types=1);

namespace Api;

use Api\Exceptions\ApiException;
use Api\Modules\UserManagement\Request\AuthRequestBody;
use Api\Modules\UserManagement\Request\AuthRequestHeader;
use Api\Utils\Util;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

abstract class ApiRequest implements ApiRequestInterface
{
    protected array $options;

    public function __construct(
        RequestHeaderInterface $authRequestHeader,
        RequestBodyInterface $authRequestBody,
    )
    {
        $this->options = $this->prepareOptions($authRequestHeader, $authRequestBody);
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param PsrResponseInterface $response
     * @return ApiResponseInterface
     * @throws Exceptions\ApiException
     */
    public function getApiResponseInstance(PsrResponseInterface $response): ApiResponseInterface
    {
        return new ApiResponse($response);
    }

    /**
     * todo refactor
     * @param AuthRequestHeader $authRequestHeader
     * @param AuthRequestBody $authRequestBody
     * @return array
     */
    private function prepareOptions(
        RequestHeaderInterface $authRequestHeader,
        RequestBodyInterface $authRequestBody
    ): array
    {
        $body = $authRequestBody->toArray();

        if ($this->method === 'GET') {
            $payload = ['uri' => $this->endpoint . '?' . http_build_query($body), 'body' => ''];
            $key = 'query';
        } elseif ($this->method === 'POST') {
            $payload = ['uri' =>  $this->endpoint, 'body' => json_encode($body)];
            $key = 'json';
        } else {
            throw new ApiException('Not implemented');
        }

        $headers = $authRequestHeader->toArray() + ['JWS-Signature' => Util::jwt($payload)];

        return ['headers' => $headers, $key => $body];
    }
}
