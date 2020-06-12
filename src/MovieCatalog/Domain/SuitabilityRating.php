<?php


namespace Application\MovieCatalog\Domain;


use Application\MovieCatalog\Domain\AbstractValue\AbstractEnumValue;

class SuitabilityRating extends AbstractEnumValue
{

    public static function allowedValues(): array
    {
        return [
            'G',
            'PG',
            'PG-13',
            'R',
            'X'
        ];
    }
}