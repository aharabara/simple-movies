<?php


namespace Application\MovieCatalog\Domain;


use Application\MovieCatalog\Domain\AbstractValue\AbstractStringValue;

class Title extends AbstractStringValue
{
    const MAXIMUM_LENGTH = 120;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \DomainException("Movie title cannot be empty.");
        }
        if (strlen($value) > self::MAXIMUM_LENGTH) {
            throw new \DomainException(sprintf("Movie title length should be less then %d characters.", self::MAXIMUM_LENGTH));
        }
        parent::__construct($value);
    }

}