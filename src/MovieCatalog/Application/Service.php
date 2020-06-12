<?php


namespace Application\MovieCatalog\Application;


use Application\MovieCatalog\Application\Command\CreateMovieCommand;
use Application\MovieCatalog\Application\Command\UpdateMovieCommand;
use Application\MovieCatalog\Application\DTO\MovieDTO;
use Application\MovieCatalog\Application\Query\GetMovieByIdQuery;
use Application\MovieCatalog\Application\Query\SearchMovieQuery;
use Application\MovieCatalog\Domain\Movie;
use Application\MovieCatalog\Infrastructure\Repository;

class Service /* @todo SPLIT INTO HANDLERS */
{
    /**
     * @var Repository
     */
    private $repository;
    /**
     * @var Transformer
     */
    private $transformer;

    public function __construct(Repository $repository, Transformer $transformer)
    {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function getById(GetMovieByIdQuery $query): MovieDTO
    {
        $movie = $this->repository->getById($query->id());
        if (null === $movie) {
            throw new \DomainException("Movie under id '{$query->id()}' was not found.");
        }
        return $this->transformer->toDTO($movie);
    }

    public function search(SearchMovieQuery $query): ?Movie
    {

    }

    public function create(CreateMovieCommand $query): ?Movie
    {

    }

    public function update(UpdateMovieCommand $query): ?Movie
    {

    }

    public function delete(Command\DeleteMovieCommand $query): ?Movie
    {

    }

}