<?php


namespace Application\MovieCatalog\Application;

use Application\MovieCatalog\Application\DTO\MovieDTO;
use Application\MovieCatalog\Domain\Collection\MovieCollection;
use Application\MovieCatalog\Domain\Movie;

class CollectionTransformer
{
    /**
     * @var Transformer
     */
    private $transformer;

    public function __construct(Transformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function toDTO(MovieCollection $collection): array
    {
        return array_map(function (Movie $movie): MovieDTO {
            return $this->transformer->toDTO($movie);
        }, iterator_to_array($collection));
    }
}