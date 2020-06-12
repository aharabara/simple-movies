<?php

namespace Application\MovieCatalog\Domain;


use Application\MovieCatalog\Domain\AbstractValue\AbstractStringValue;

class MovieId extends AbstractStringValue
{
    public function __construct(string $value)
    {
        if (empty($value)){
            throw new \RuntimeException("Movie id cannot be empty string.");
        }
        parent::__construct($value);
    }
}