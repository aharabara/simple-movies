<?php

namespace Application\MovieCatalog\Application\Command;

class DeleteMovieCommand
{
    private $movieId;

    public function __construct(string $id)
    {
        $this->movieId = $id;
    }

    public function getMovieId(): string
    {
        return $this->movieId;
    }
}