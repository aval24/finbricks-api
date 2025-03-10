<?php

declare(strict_types=1);

namespace Api\Utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use UnexpectedValueException;

class NotificationJwtVerifier
{
    private string $verificationKey;

    public function __construct()
    {
        $this->verificationKey = file_get_contents(__DIR__ . '/../../../src/config/verificationKey');
    }

    public function verify(string $jwsToken): bool
    {
        try {
            JWT::decode($jwsToken, new Key($this->verificationKey, 'RS256'));
            return true;
        } catch (UnexpectedValueException $e) {
            return false;
        }
    }
}
