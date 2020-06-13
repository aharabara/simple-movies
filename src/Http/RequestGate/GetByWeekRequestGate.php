<?php

namespace Application\Http\RequestGate;

use Respect\Validation\Validator as v;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Route;

class GetByIdRequestGate extends AbstractGate
{

    public function validate(ServerRequestInterface $request)
    {
        /** @var Route $route */
        $route = $request->getAttribute('route');
        v::key('week', v::intVal()->notEmpty())
            ->assert($route->getArguments());
    }
}