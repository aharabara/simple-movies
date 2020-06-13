<?php

namespace Application\Http\Controller;

use Application\MovieCatalog\Application\Command\CreateMovieCommand;
use Application\MovieCatalog\Application\Command\DeleteMovieCommand;
use Application\MovieCatalog\Application\Command\UpdateMovieCommand;
use Application\MovieCatalog\Application\Query\GetMovieByIdQuery;
use Application\MovieCatalog\Application\Query\SearchMovieQuery;
use Application\MovieCatalog\Application\Service;
use Slim\Http\Request;
use Slim\Http\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
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
        return $this->response($response, $this->movieService->getById(new GetMovieByIdQuery($request->getAttribute('movieId'))));

    }

    public function search(Request $request, Response $response): Response
    {
        return $this->response($response, $this->movieService->search(
            new SearchMovieQuery(
                $request->getQueryParam('title'),
                $request->getQueryParam('genre'),
                $request->getQueryParam('page'),
                $request->getQueryParam('week'),
            )
        ));

    }

    public function getByWeek(Request $request, Response $response): Response
    {
        return $this->response($response, $this->movieService->search(
            new SearchMovieQuery(null, null, null, $request->getAttribute('week'))
        ));

    }

    public function create(Request $request, Response $response): Response
    {
        return $this->response($response, $this->movieService->create(
            new CreateMovieCommand(
                $request->getParam('title'),
                $request->getParam('genre'),
                $request->getParam('year'),
                $request->getParam('runtime'),
                $request->getParam('suitabilityRating'),
                $request->getParam('releaseDate'),
            )
        ));

    }

    public function update(Request $request, Response $response): Response
    {
        return $this->response($response, $this->movieService->update(
            new UpdateMovieCommand(
                $request->getParam('title'),
                $request->getParam('genre'),
                $request->getParam('year'),
                $request->getParam('runtime'),
                $request->getParam('suitabilityRating'),
                $request->getParam('releaseDate'),
                $request->getAttribute('movieId'),
            )
        ));

    }

    public function delete(Request $request, Response $response): Response
    {
        return $this->response($response, $this->movieService->delete(
            new DeleteMovieCommand($request->getAttribute('movieId'))
        ));
    }

    /**
     * @param object|string $response
     * @return mixed
     * @throws ExceptionInterface
     */
    private function response(Response $response, $payload)
    {
        return $response->withJson(
            $this->serializer->normalize(
                $payload
            )
        );
    }

}