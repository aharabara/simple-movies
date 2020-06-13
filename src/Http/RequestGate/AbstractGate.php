<?php

namespace Application\Http\RequestGate;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractGate
{
    /**
     * @param ServerRequestInterface $request  PSR7 request
     * @param ResponseInterface $response PSR7 response
     * @param callable                                 $next     Next middleware
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $this->validate($request);
        return $next($request, $response);
    }

    abstract public function validate(ServerRequestInterface $request);
}