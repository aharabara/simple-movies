<?php


namespace Application\MovieCatalog\Application;


use Application\MovieCatalog\Application\Command\CreateMovieCommand;
use Application\MovieCatalog\Application\Command\DeleteMovieCommand;
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
    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        $this->transformer = new Transformer();
        $this->collectionTransformer = new CollectionTransformer($this->transformer);
    }

    /**
     * @param GetMovieByIdQuery $query
     * @return MovieDTO
     */
    public function getById(GetMovieByIdQuery $query): MovieDTO
    {
        $movie = $this->repository->getById($query->getMovieId());
        if (null === $movie) {
            throw new \DomainException("Movie under id '{$query->getMovieId()}' was not found.");
        }
        return $this->transformer->toDTO($movie);
    }

    /**
     * @param SearchMovieQuery $query
     * @return MovieDTO[]
     */
    public function search(SearchMovieQuery $query): array
    {
        $movies = $this->repository->search($query);
        if ($movies->empty()) {
            throw new \DomainException("There is no movies under specified filtering criteria.");
        }
        return $this->collectionTransformer->toDTO($movies);
    }

    public function create(CreateMovieCommand $query): string
    {
        $movie = $this->transformer->fromDTO($query, $this->repository->generateId());
        $this->repository->save($movie);
        return $movie->movieId();
    }

    public function update(UpdateMovieCommand $query): string
    {
        $movie = $this->repository->getById($query->getMovieId());
        if (null === $movie) {
            throw new \DomainException("Movie under id '{$query->getMovieId()}' was not found.");
        }

        $movie = $this->transformer->fromDTO($query, $movie->movieId());
        $this->repository->save($movie);
        return $movie->movieId();
    }

    public function delete(DeleteMovieCommand $query): string
    {
        $movie = $this->repository->getById($query->getMovieId());
        if (null === $movie) {
            throw new \DomainException("Movie under id '{$query->getMovieId()}' was not found.");
        }
        $this->repository->delete($movie->movieId());
        return $movie->movieId();
    }

}