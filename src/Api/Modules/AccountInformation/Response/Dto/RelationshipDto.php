<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response\Dto;

class RelationshipDto
{
    public function __construct(
        public bool $isOwner
    ) {
    }
}
