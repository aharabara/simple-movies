<?php


namespace Application\MovieCatalog\Application\DTO;

abstract class AbstractMovieDTO
{
    /** @var string */
    private $title;
    /** @var string */
    private $genre;
    /** @var int */
    private $year;
    /** @var int */
    private $runtime;
    /** @var string */
    private $suitabilityRating;
    /** @var \DateTimeImmutable */
    private $releaseDate;

    public function __construct(
        string $title,
        string $genre,
        int $year,
        int $runtime,
        string $suitabilityRating,
        string $releaseDate
    )
    {
        $this->title = $title;
        $this->genre = $genre;
        $this->year = $year;
        $this->runtime = $runtime;
        $this->suitabilityRating = $suitabilityRating;
        $this->releaseDate = new \DateTimeImmutable($releaseDate);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /**
     * @return string
     */
    public function getSuitabilityRating(): string
    {
        return $this->suitabilityRating;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getReleaseDate(): \DateTimeImmutable
    {
        return $this->releaseDate;
    }

}