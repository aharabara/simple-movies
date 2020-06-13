<?php

namespace Application\MovieCatalog\Domain\Collection;


use Application\MovieCatalog\Domain\AbstractValue\AbstractValueCollection;
use Application\MovieCatalog\Domain\Movie;

class MovieCollection extends AbstractValueCollection
{

    public static function getCollectionItemClassName(): string
    {
        return Movie::class;
    }

    public function empty(): bool
    {
        return $this->count() === 0;
    }
}