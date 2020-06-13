<?php

namespace Application\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class JsonEndpointMiddleware
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
        return $next($request, $response)
            ->withHeader('Content-Type', 'application/json');
    }

}