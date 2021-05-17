<?php

namespace Barkyn\Infrastructure\Http\Middleware;

use Barkyn\Application\Configuration\AppConfig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Exception\HttpUnauthorizedException;

class DummyAuthMiddleware extends BaseMiddleware
{
    /**
     * @var AppConfig $appConfig
     */
    private AppConfig $appConfig;

    /**
     * DummyAuthMiddleware constructor.
     *
     * @param AppConfig $appConfig
     */
    public function __construct(AppConfig $appConfig)
    {
        $this->appConfig = $appConfig;
    }

    /**
     * @param Request        $request
     * @param RequestHandler $handler
     *
     * @return ResponseInterface
     * @throws HttpUnauthorizedException
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        if (strcmp($request->getHeaderLine('Authorization'), 'Bearer ' . $this->appConfig->getToken()) !== 0) {
            throw new HttpUnauthorizedException($request);
        }

        return $handler->handle($request);
    }
}
