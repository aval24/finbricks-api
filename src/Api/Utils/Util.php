<?php

declare(strict_types=1);

namespace Api\Utils;

use Firebase\JWT\JWT;

class Util {

    public static function jwt($payload): string {
        $config = require __DIR__ . '/../../../src/config/config.php';

        $jwt = JWT::encode($payload, $config['key'], 'RS256', null, ['kid' => $config['merchantId']]);
        list($header, , $signature) = explode('.', $jwt);

        return $header . '..' . $signature;
    }
}