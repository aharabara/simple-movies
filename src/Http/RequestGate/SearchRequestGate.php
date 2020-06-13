<?php

namespace Application\Http\RequestGate;

use Respect\Validation\Validator as v;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Route;

class SearchRequestGate extends AbstractGate
{

    public function validate(ServerRequestInterface $request)
    {
        $maxAmountOfWeeksInYear = 53;
        v::key('title', v::stringType()->notBlank(), false)
            ->key('genre', v::stringType()->notBlank(), false)
            ->key('page', v::intVal()->min(0)->max(PHP_INT_MAX), false)
            ->key('week', v::intVal()->min(0)->max($maxAmountOfWeeksInYear), false)
            ->assert($request->getQueryParams());
    }
}