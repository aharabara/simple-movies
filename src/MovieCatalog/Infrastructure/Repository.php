<?php


namespace Application\MovieCatalog\Infrastructure;


use App\MovieCatalog\Adapter\_Hydrator;
use App\MovieCatalog\Adapter\Hydrator;
use Application\MovieCatalog\Application\Query\SearchMovieQuery;
use Application\MovieCatalog\Domain\Collection\MovieCollection;
use Application\MovieCatalog\Domain\Movie;
use Application\MovieCatalog\Domain\MovieId;
use PharIo\Manifest\RequiresElementTest;

class Repository
{

    /**
     * @var Hydrator
     */
    private $hydrator;

    public function __construct(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function getById(string $id): ?Movie
    {

    }

    public function search(SearchMovieQuery $query): MovieCollection
    {
    }

    public function generateId(): MovieId
    {
        return new MovieId('');
    }

    public function save(Movie $movie): void
    {

    }


}