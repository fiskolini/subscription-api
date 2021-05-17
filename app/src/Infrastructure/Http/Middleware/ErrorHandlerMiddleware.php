<?php

namespace Barkyn\Infrastructure\Http\Middleware;

use Barkyn\Application\Configuration\Environment;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\App;
use Throwable;

class ErrorHandlerMiddleware extends BaseMiddleware
{
    /**
     * @var App $app
     */
    private App $app;

    /**
     * @var Environment $env
     */
    private Environment $env;

    /**
     * DummyAuthMiddleware constructor.
     *
     * @param App         $app
     * @param Environment $env
     */
    public function __construct(App $app, Environment $env)
    {
        $this->app = $app;
        $this->env = $env;
    }

    /**
     * @param Request        $request
     * @param RequestHandler $handler
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Throwable $exception) {
            if ($exception->getCode() === 0) {
                $code = 500;
                $error = !$this->env->isDev() ? 'Server Error.' : $exception->getMessage();
            } else {
                $code = $exception->getCode();
                $error = $exception->getMessage();
            }

            $payload = ['Error' => $error];

            $response = $this->app->getResponseFactory()->createResponse()
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($code);

            $response->getBody()->write(json_encode($payload, JSON_UNESCAPED_UNICODE));

            return $response;
        }
    }
}
