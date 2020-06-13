<?php

namespace Application\Http\RequestGate;

use Respect\Validation\Validator as v;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Route;

class CreateMovieGate extends AbstractGate
{

    public function validate(ServerRequestInterface $request)
    {
        $currentYear = new \DateTimeImmutable();
        $firstMovieCreationYear = (new \DateTimeImmutable())->setDate(1888, 1, 1);
        $format = "Y-m-d";

        v::key('title', v::stringType()->notBlank())
            ->key('genre', v::stringType()->notBlank())
            ->key('year', v::intType()->min($firstMovieCreationYear->format("Y"))->max($currentYear->format("Y")))
            ->key('runtime', v::intType()->min(0))
            ->key('suitabilityRating', v::stringType()->notBlank())
            ->key('releaseDate', v::date($format)->min($firstMovieCreationYear->format($format)))
            ->assert($request->getParsedBody());
    }
}