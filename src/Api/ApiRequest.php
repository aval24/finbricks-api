<?php

declare(strict_types=1);

namespace Api;

use Api\Exceptions\ApiException;
use Api\Utils\Util;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

abstract class ApiRequest implements ApiRequestInterface
{
    /**
     * @var string
     */
    protected string $endpoint;

    /**
     * @var string
     */
    protected string $method;

    /**
     * @var array
     */
    protected array $options;

    /**
     * @throws ApiException
     */
    public function __construct(
        protected RequestHeaderInterface $authRequestHeader,
        protected RequestBodyInterface $authRequestBody,
        protected Util $util
    ) {
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
     * @param RequestHeaderInterface $authRequestHeader
     * @param RequestBodyInterface $authRequestBody
     * @return array
     * @throws ApiException
     */
    private function prepareOptions(
        RequestHeaderInterface $authRequestHeader,
        RequestBodyInterface $authRequestBody
    ): array {
        $body = $authRequestBody->toArray();

        switch ($this->method) {
            case 'GET':
                $payload = ['uri' => $this->endpoint . '?' . http_build_query($body, ''), 'body' => ''];
                $key = 'query';
                break;
            case 'POST':
                $payload = ['uri' =>  $this->endpoint, 'body' => json_encode($body)];
                $key = 'json';
                break;
            default:
                throw new ApiException('Not implemented', 0, 500);
        }

        try {
            $headers = $authRequestHeader->toArray() + ['JWS-Signature' => $this->util->jwt($payload)];
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage(), 0, 403);
        }

        return ['headers' => $headers, $key => $body];
    }
}
