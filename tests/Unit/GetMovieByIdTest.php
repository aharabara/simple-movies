<?php

namespace Unit;

use Application\MovieCatalog\Application\Query\GetMovieByIdQuery;
use Application\MovieCatalog\Application\Service;
use Application\MovieCatalog\Application\Transformer;
use Application\MovieCatalog\Infrastructure\Repository;
use PHPUnit\Framework\TestCase;
use Utility\Factory;

class GetMovieByIdTest extends TestCase
{
    public function testGetById()
    {
        $factory = new Factory();
        $transformer = new Transformer();

        $movie = $factory->createMovie();
        $query = new GetMovieByIdQuery($movie->movieId());

        $repository = $this->getMockBuilder(Repository::class)->disableOriginalConstructor()->getMock();

        $repository
            ->method('getById')
            ->with($query->getMovieId())
            ->willReturn($movie);

        $service = new Service($repository);

        self::assertEquals($transformer->toDTO($movie), $service->getById($query));
    }
}