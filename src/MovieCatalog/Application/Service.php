<?php


namespace Application\MovieCatalog\Application;


use Application\MovieCatalog\Domain\Movie;
use Application\MovieCatalog\Infrastructure\Repository;

class Service /* @todo SPLIT INTO HANDLERS */
{
    /**
     * @var Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getById(GetByIdQuery $query): ?Movie
    {

    }

    public function search(SearchQuery $query): ?Movie
    {

    }

    public function create(Command\CreateMovieCommand $query): ?Movie
    {

    }

    public function update(Command\UpdateMovieCommand $query): ?Movie
    {

    }

    public function delete(Command\DeleteMovieCommand $query): ?Movie
    {

    }

}