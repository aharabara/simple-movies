<?php

namespace Unit;

use Application\MovieCatalog\Application\CollectionTransformer;
use Application\MovieCatalog\Application\Query\SearchMovieQuery;
use Application\MovieCatalog\Application\Service;
use Application\MovieCatalog\Application\Transformer;
use Application\MovieCatalog\Domain\Collection\MovieCollection;
use Application\MovieCatalog\Infrastructure\Repository;
use PHPUnit\Framework\TestCase;
use Utility\Factory;

class SearchMovieTest extends TestCase
{
    public function testSearch()
    {
        $factory = new Factory();
        $transformer = new Transformer();

        $movies = new MovieCollection([$factory->createMovie(), $factory->createMovie()]);

        $query = new SearchMovieQuery('My movie title', 'My genre', 1);

        $repository = $this->getMockBuilder(Repository::class)->disableOriginalConstructor()->getMock();

        $repository
            ->method('search')
            ->with($query)
            ->willReturn($movies);

        $service = new Service($repository, $transformer);

        $collectionTransformer = new CollectionTransformer($transformer);
        self::assertEquals($collectionTransformer->toDTO($movies), $service->search($query));
    }
}