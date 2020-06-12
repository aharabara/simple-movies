<?php

namespace Application\MovieCatalog\Domain\AbstractValue;

abstract class AbstractValueCollection implements \Iterator
{

    /** @var array */
    private $items;

    public function __construct(iterable $items)
    {
        if (!is_array($items)) {
            $items = iterator_to_array($items);
        }
        $class = $this::getCollectionItemClassName();
        foreach ($items as $item) {
            if (!$item instanceof $class) {
                throw new \RuntimeException('Collection "%s" cannot accept "%s"', __CLASS__, $class);
            }
        }
        $this->items = $items;
    }

    public function rewind()
    {
        return reset($this->items);
    }

    public function current()
    {
        return current($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function next()
    {
        return next($this->items);
    }

    public function valid()
    {
        return key($this->items) !== null;
    }

    abstract public static function getCollectionItemClassName(): string;
}