<?php


namespace Application\MovieCatalog\Application;

use Application\MovieCatalog\Application\DTO\MovieDTO;
use Application\MovieCatalog\Domain\Movie;

class Transformer
{

    public function toDTO(Movie $movie): MovieDTO
    {
        return new MovieDTO(
            $movie->id(),
            $movie->title(),
            $movie->genre(),
            $movie->year()->value(),
            $movie->runtime()->value(),
            $movie->suitabilityRating()
        );
    }

    public function fromDTO(MovieDTO $dto, Movie $movie): Movie{
        $movie->setYear($dto->getYear());
        $movie->setRuntime($dto->getRuntime());
        $movie->setTitle($dto->getTitle());
        $movie->setGenre($dto->getTitle());
        $movie->setSuitabilityRating($dto->getSuitabilityRating());

        return $movie;
    }
}