<?php

declare(strict_types=1);

namespace Api\Config;

class Config
{
    public function __construct(
        private readonly string $baseUri,
        private readonly string $merchantId,
        private readonly string $key
    ) {
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
