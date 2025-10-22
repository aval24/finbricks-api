<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response\Dto;

class AccountIdentificationDto
{
    /**
     * @param AccountIdentificationOthersDto[] $others
     */
    public function __construct(
        public ?string $accountNumber,
        public ?string $iban,
        public array $others = []
    ) {
    }
}
