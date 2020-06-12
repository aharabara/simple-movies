<?php


namespace Application\MovieCatalog\Domain;


class Movie
{
    /** @var MovieId */
    private $id;
    /** @var Title  */
    private $title;
    /** @var Genre */
    private $genre;
    /** @var Year  */
    private $year;
    /** @var Runtime */
    private $runtime;
    /** @var SuitabilityRating  */
    private $suitabilityRating;

    public function __construct(
        MovieId $id,
        Title $title,
        Genre $genre,
        Year $year,
        Runtime $runtime,
        SuitabilityRating $suitabilityRating
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
     * @return MovieId
     */
    public function id(): MovieId
    {
        return $this->id;
    }

    /**
     * @return Title
     */
    public function title(): Title
    {
        return $this->title;
    }

    /**
     * @return Genre
     */
    public function genre(): Genre
    {
        return $this->genre;
    }

    /**
     * @return Year
     */
    public function year(): Year
    {
        return $this->year;
    }

    /**
     * @return Runtime
     */
    public function runtime(): Runtime
    {
        return $this->runtime;
    }

    /**
     * @return SuitabilityRating
     */
    public function suitabilityRating(): SuitabilityRating
    {
        return $this->suitabilityRating;
    }

    /**
     * @param Title $title
     */
    public function setTitle(Title $title): void
    {
        $this->title = $title;
    }

    /**
     * @param Genre $genre
     */
    public function setGenre(Genre $genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @param Year $year
     */
    public function setYear(Year $year): void
    {
        $this->year = $year;
    }

    /**
     * @param Runtime $runtime
     */
    public function setRuntime(Runtime $runtime): void
    {
        $this->runtime = $runtime;
    }

    /**
     * @param SuitabilityRating $suitabilityRating
     */
    public function setSuitabilityRating(SuitabilityRating $suitabilityRating): void
    {
        $this->suitabilityRating = $suitabilityRating;
    }

}