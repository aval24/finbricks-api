<?php

declare(strict_types=1);

namespace Api\Exceptions;

class ApiException extends \Exception
{
    public function __construct(protected $message, protected $code, protected $httpStatus)
    {
        parent::__construct($message, $httpStatus);
    }

    public function getApiCode(): int
    {
        return $this->code;
    }

    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'httpCode' => $this->httpStatus,
            'message' => $this->message,
        ];
    }
}
