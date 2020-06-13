<?php

namespace Application\Http\Controller;

use Application\MovieCatalog\Application\Query\GetMovieByIdQuery;
use Application\MovieCatalog\Application\Query\SearchMovieQuery;
use Application\MovieCatalog\Application\Service;
use Slim\Http\Request;
use Slim\Http\Response;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class MovieController
{
    /**
     * @var Service
     */
    private $movieService;
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Service $movieService)
    {
        $this->movieService = $movieService;
        $this->serializer = new Serializer([new DateTimeNormalizer(), new GetSetMethodNormalizer(), new ArrayDenormalizer()]);
    }

    public function getById(Request $request, Response $response): Response
    {
        $movie = $this->movieService->getById(new GetMovieByIdQuery($request->getAttribute('id')));
        return $response->withJson($this->serializer->normalize($movie));
    }

    public function search(Request $request, Response $response): Response
    {
        $query = new SearchMovieQuery(
            $request->getQueryParam('title'),
            $request->getQueryParam('genre'),
            $request->getQueryParam('page'),
            $request->getQueryParam('week'),
        );
        return $response->withJson(
            $this->serializer->normalize(
                $this->movieService->search($query)
            )
        );
    }

    public function getByWeek(Request $request, Response $response): Response
    {
        return $response->withJson(
            $this->serializer->normalize(
                $this->movieService->search(
                    new SearchMovieQuery(null, null, null, $request->getAttribute('week'))
                )
            )
        );
    }

    public function create(Request $request, Response $response): Response
    {
        return $response;
    }

    public function update(Request $request, Response $response): Response
    {
        return $response;
    }

}