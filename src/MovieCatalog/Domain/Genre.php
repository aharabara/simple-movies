<?php


namespace Application\MovieCatalog\Domain;


use Application\MovieCatalog\Domain\AbstractValue\AbstractEnumValue;

class Genre extends AbstractEnumValue
{
    public static function allowedValues(): array
    {
        return [
            'action',
            'adventure',
            'comedy',
            'crime & gangsters',
            'drama',
            'historical',
            'horror',
            'musical',
            'science fiction',
            'war',
            'western',
        ];
    }

}