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
            id: $data['id'],
            accountName: $data['accountName'] ?? null,
            productName: $data['productName'],
            balance: (string) $data['balance'],
            currency: $data['currency'],
            balanceType: $data['balanceType'],
            creditDebitIndicator: $data['creditDebitIndicator'],
            pispSuitable: $data['pispSuitable'],
            ownersNames: $data['ownersNames'],
            identification: $identification,
            relationship: $relationship,
            dateTime: new DateTime($data['dateTime']),
            bic: $data['bic']
        );
    }
}
