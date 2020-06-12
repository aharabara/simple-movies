<?php

namespace Application\MovieCatalog\Application\Query;

class GetMovieByIdQuery
{
    /** @var string */
    private $movieId;

    public function __construct(string $movieId)
    {
        $this->movieId = $movieId;
    }

    public function id():string
    {
        return $this->movieId;
    }
}