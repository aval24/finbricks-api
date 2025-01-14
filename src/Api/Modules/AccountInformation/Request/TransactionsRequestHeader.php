<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Request;

use Api\RequestHeaderInterface;

class TransactionsRequestHeader implements RequestHeaderInterface
{
    public function __construct(
    ) {
        //$this->validate();
    }

    //private function validate(): void {}

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [

        ];
    }
}
