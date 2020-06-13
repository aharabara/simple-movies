<?php

namespace Application\Http\Middleware;

use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Respect\Validation\Exceptions\AllOfException;
use Slim\Container;
use Slim\Http\StatusCode;
use Throwable;

class ExceptionHandlingMiddleware
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(Container $container)
    {
        $this->logger = $container->get(LoggerInterface::class);
    }

    /**
     * @param ServerRequestInterface $request PSR7 request
     * @param ResponseInterface $response PSR7 response
     * @param callable $next Next middleware
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        try {
            return $next($request, $response);
        } catch (AllOfException $exception) {
            $body = $this->getResponseBody(
                $exception->getCode(),
                $exception->getMessage(),
                $exception->getMessages()
            );
            $response = $response->withStatus(StatusCode::HTTP_BAD_REQUEST);
        } catch (LogicException $exception) {
            $body = $this->getResponseBody($exception->getCode(), $exception->getMessage(), []);
            $response = $response->withStatus(StatusCode::HTTP_BAD_REQUEST);
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage() . "\n" . $exception->getTraceAsString());
            $body = $this->getResponseBody(-1, "Internal error.", []);
            $response = $response->withStatus(StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response->getBody()->write($body);
        return $response;
    }

    /**
     * @param int $code
     * @param string $message
     * @param array $reasons
     * @return string
     */
    private function getResponseBody(int $code, string $message, array $reasons): string
    {
        return json_encode([
            'code' => $code,
            'message' => $message,
            'reasons' => $reasons,
        ]);
    }

}