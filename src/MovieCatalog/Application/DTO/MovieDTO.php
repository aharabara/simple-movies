<?php


namespace Application\MovieCatalog\Application\DTO;

class MovieDTO extends AbstractMovieDTO
{
    /** @var string */
    private $movieId;

    public function __construct(
        string $title,
        string $genre,
        int $year,
        int $runtime,
        string $suitabilityRating,
        string $releaseDate,
        string $id
    )
    {
        parent::__construct($title, $genre, $year, $runtime, $suitabilityRating, $releaseDate);
        $this->movieId = $id;
    }

    /**
     * @return string
     */
    public function getMovieId(): string
    {
        return $this->movieId;
    }
}