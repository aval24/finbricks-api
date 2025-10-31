<?php

declare(strict_types=1);

namespace Api\Modules\TransactionInitialization\Request;

use Api\BaseRequestHeader;
use Api\RequestHeaderInterface;

class TransactionPlatformInitRequestHeader extends BaseRequestHeader implements RequestHeaderInterface
{
    public function __construct(
        protected string $psuIpAddress,
        protected string $psuUserAgent,
    ) {
        parent::__construct(
            psuIpAddress: $psuIpAddress,
            psuUserAgent: $psuUserAgent,
        );
    }
}
