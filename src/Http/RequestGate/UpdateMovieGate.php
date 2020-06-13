<?php

namespace Application\Http\RequestGate;

use Respect\Validation\Validator as v;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Route;

class UpdateMovieGate extends CreateMovieGate
{

    public function validate(ServerRequestInterface $request)
    {
        /** @var Route $route */
        $route = $request->getAttribute('route');
        v::key('movieId', v::stringType()->notBlank())->assert($route->getArguments());
        parent::validate($request);
    }
}