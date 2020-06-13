<?php
/** @var App $app */

use Application\Http\Controller\MovieController;
use Application\Http\Middleware\ExceptionHandlingMiddleware;
use Application\Http\Middleware\JsonEndpointMiddleware;
use Application\Http\RequestGate\GetByIdRequestGate;
use Application\Http\RequestGate\SearchRequestGate;
use Slim\App;


/** @var MovieController $controller*/
$controller = $app->getContainer()->get(MovieController::class);
$app->get('/movies/{id}', [$controller, 'getById'])
    ->add(GetByIdRequestGate::class);

$app->get('/movies/by-week/{week}', [$controller, 'getByWeek'])
    ->add(GetByIdWeekGate::class);
;
$app->get('/movies', [$controller, 'search'])
    ->add(SearchRequestGate::class)
;
$app->post('/movies', [$controller, 'create']);
$app->put('/movies', [$controller, 'update']);
$app->add(ExceptionHandlingMiddleware::class);
$app->add(JsonEndpointMiddleware::class);
