<?php


namespace Application\MovieCatalog\Domain;


class Movie
{
    /** @var MovieId */
    private $movieId;
    /** @var Title  */
    private $title;
    /** @var Genre */
    private $genre;
    /** @var Year  */
    private $year;
    /** @var Year  */
    private $releaseDate;
    /** @var Runtime */
    private $runtime;
    /** @var SuitabilityRating  */
    private $suitabilityRating;

    public function __construct(
        MovieId $movieId,
        Title $title,
        Genre $genre,
        Year $year,
        Runtime $runtime,
        SuitabilityRating $suitabilityRating,
        ReleaseDate $releaseDate
    )
    {
        $this->movieId = $movieId;
        $this->title = $title;
        $this->genre = $genre;
        $this->year = $year;
        $this->runtime = $runtime;
        $this->suitabilityRating = $suitabilityRating;
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return MovieId
     */
    public function movieId(): MovieId
    {
        return $this->movieId;
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
     * @return ReleaseDate
     */
    public function releaseDate(): ReleaseDate
    {
        return $this->releaseDate;
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

    /**
     * @param ReleaseDate $releaseDate
     */
    public function setReleaseDate(ReleaseDate $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

}