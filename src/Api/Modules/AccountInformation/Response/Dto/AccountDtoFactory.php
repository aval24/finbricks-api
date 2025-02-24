<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response\Dto;

use DateTime;

class AccountDtoFactory
{
    public static function fromArray(array $data): AccountsWithBalanceResponseDto
    {
        $identification = new AccountIdentificationDto(
            $data['identification']['accountNumber'],
            $data['identification']['iban'],
            array_map(
                fn ($others) => new AccountIdentificationOthersDto($others['type'], $others['value']),
                $data['identification']['others'] ?? []
            )
        );

        $relationship = isset($data['relationship']) ? new RelationshipDto($data['relationship']['isOwner']) : null;

        return new AccountsWithBalanceResponseDto(
            $data['id'],
            $data['accountName'],
            $data['productName'],
            (string) $data['balance'],
            $data['currency'],
            $data['balanceType'],
            $data['creditDebitIndicator'],
            $data['pispSuitable'],
            $data['ownersNames'],
            $identification,
            $relationship,
            new DateTime($data['dateTime']),
            $data['bic']
        );
    }
}
