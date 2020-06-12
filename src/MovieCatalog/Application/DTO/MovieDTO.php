<?php


namespace Application\MovieCatalog\Application\DTO;

class MovieDTO
{
    /** @var string */
    private $id;
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

    public function __construct(
        string $id,
        string $title,
        string $genre,
        int $year,
        int $runtime,
        string $suitabilityRating
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->genre = $genre;
        $this->year = $year;
        $this->runtime = $runtime;
        $this->suitabilityRating = $suitabilityRating;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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

}