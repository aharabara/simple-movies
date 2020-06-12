<?php
namespace Application\MovieCatalog\Domain\AbstractValue;


abstract class AbstractStringValue
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    final public function __toString()
    {
        return $this->value;
    }
}