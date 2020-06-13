<?php
/** @var App $app */

use Application\Http\Controller\MovieController;
use Application\Http\Middleware\ExceptionHandlingMiddleware;
use Application\Http\Middleware\JsonEndpointMiddleware;
use Application\Http\RequestGate\CreateMovieGate;
use Application\Http\RequestGate\GetByWeekRequestGate;
use Application\Http\RequestGate\MovieIdRequestGate;
use Application\Http\RequestGate\SearchRequestGate;
use Slim\App;


/** @var MovieController $controller */
$controller = $app->getContainer()->get(MovieController::class);
$app->get('/movies/{id}', [$controller, 'getById'])
    ->add(MovieIdRequestGate::class);

$app->get('/movies/by-week/{week}', [$controller, 'getByWeek'])
    ->add(GetByWeekRequestGate::class);;

    $app->get('/movies', [$controller, 'search'])
    ->add(SearchRequestGate::class);

$app->post('/movies', [$controller, 'create'])
    ->add(CreateMovieGate::class);

$app->put('/movies/{movieId}', [$controller, 'update'])
    ->add(MovieIdRequestGate::class)
    ->add(CreateMovieGate::class);

$app->delete('/movies/{movieId}', [$controller, 'delete'])
    ->add(MovieIdRequestGate::class);

$app->add(ExceptionHandlingMiddleware::class);
$app->add(JsonEndpointMiddleware::class);
