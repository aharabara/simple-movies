<?php


namespace Application\MovieCatalog\Application;

use Application\MovieCatalog\Application\DTO\AbstractMovieDTO;
use Application\MovieCatalog\Application\DTO\MovieDTO;
use Application\MovieCatalog\Domain\Genre;
use Application\MovieCatalog\Domain\Movie;
use Application\MovieCatalog\Domain\MovieId;
use Application\MovieCatalog\Domain\ReleaseDate;
use Application\MovieCatalog\Domain\Runtime;
use Application\MovieCatalog\Domain\SuitabilityRating;
use Application\MovieCatalog\Domain\Title;
use Application\MovieCatalog\Domain\Year;

class Transformer
{

    public function toDTO(Movie $movie): MovieDTO
    {
        return new MovieDTO(
            $movie->title(),
            $movie->genre(),
            $movie->year()->value(),
            $movie->runtime()->value(),
            $movie->suitabilityRating(),
            $movie->releaseDate()->format(\DateTimeInterface::ATOM),
            $movie->movieId()
        );
    }

    public function fromDTO(AbstractMovieDTO $dto, MovieId $movieId): Movie
    {
        return new Movie(
            $movieId,
            new Title($dto->getTitle()),
            new Genre($dto->getGenre()),
            new Year($dto->getYear()),
            new Runtime($dto->getRuntime()),
            new SuitabilityRating($dto->getSuitabilityRating()),
            new ReleaseDate($dto->getReleaseDate())
        );
    }
}