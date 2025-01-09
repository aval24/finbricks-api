<?php

declare(strict_types=1);

namespace Api\Utils;

use Api\Config\Config;
use Firebase\JWT\JWT;

class Util
{
    public function __construct(protected Config $config)
    {
    }
    /**
     * @param $payload
     * @return string
     */
    public function jwt($payload): string
    {
        $jwt = JWT::encode(
            $payload,
            $this->config->get('key'),
            'RS256',
            null,
            ['kid' => $this->config->get('merchantId')]
        );

        list($header, , $signature) = explode('.', $jwt);

        return $header . '..' . $signature;
    }
}
