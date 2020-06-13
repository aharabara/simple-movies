<?php

namespace Application\MovieCatalog\Application\Query;

class SearchMovieQuery
{
    /** @var string|null */
    private $title;
    /** @var string|null */
    private $genre;
    /** @var int|null */
    private $page;
    /** @var int|null */
    private $week;

    public function __construct(?string $title, ?string $genre, ?int $page, ?int $week)
    {
        $this->title = $title;
        $this->genre = $genre;
        $this->page = $page;
        $this->week = $week;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function getWeek(): ?int
    {
        return $this->week;
    }
}