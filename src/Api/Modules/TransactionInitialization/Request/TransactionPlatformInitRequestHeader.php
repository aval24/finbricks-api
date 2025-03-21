<?php

declare(strict_types=1);

namespace Api\Modules\TransactionInitialization\Request;

use Api\RequestHeaderInterface;

class TransactionPlatformInitRequestHeader implements RequestHeaderInterface
{
    public function __construct()
    {
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
