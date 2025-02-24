<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response\Dto;

class AccountIdentificationOthersDto
{
    public function __construct(
        public string $type,
        public string $value,
    ) {
    }
}
