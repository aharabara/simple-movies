<?php


namespace Application\MovieCatalog\Domain;


use Application\MovieCatalog\Domain\AbstractValue\AbstractIntValue;

class Year extends AbstractIntValue
{
    public function fromDateTime(\DateTimeInterface $dateTime): Year
    {
        return new static($dateTime->format('Y'));
    }
}