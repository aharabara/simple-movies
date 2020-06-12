<?php

namespace Application\MovieCatalog\Domain\AbstractValue;


abstract class AbstractEnumValue extends AbstractStringValue
{
    protected const EXCEPTION_MESSAGE = "Value '%s' is not allowed. Allowed values : %s";


    public function __construct(string $value)
    {
        $allowedValues = static::allowedValues();
        if (!in_array($value, $allowedValues, true)) {
            throw new \DomainException(sprintf(self::EXCEPTION_MESSAGE, $value, implode($allowedValues)));
        }
        parent::__construct($value);
    }

    abstract public static function allowedValues(): array;
}