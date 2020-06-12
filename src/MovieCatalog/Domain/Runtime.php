<?php

namespace Application\MovieCatalog\Domain;

use Application\MovieCatalog\Domain\AbstractValue\AbstractIntValue;

class Runtime extends AbstractIntValue
{
    public function __construct(?int $value)
    {
        if ($value !== null && $value <= 0){
            throw new \DomainException("Movie runtime cannot be zero or less.");
        }

        parent::__construct($value);
    }
}