<?php
namespace Application\MovieCatalog\Domain\AbstractValue;


abstract class AbstractIntValue
{
    /** @var int */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    final public function value(): int
    {
        return $this->value;
    }
}