<?php

namespace Barkyn\Infrastructure\Http\Actions;

use Barkyn\Application\Configuration\AppConfig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use function OpenApi\scan;

class OpenApiAction extends BaseAction
{
    /**
     * @var AppConfig
     */
    private AppConfig $appConfig;

    /**
     * OpenApiAction constructor.
     *
     * @param AppConfig $appConfig
     */
    public function __construct(AppConfig $appConfig)
    {
        $this->appConfig = $appConfig;
    }

    /**
     * @param ServerRequestInterface                   $request
     * @param ResponseInterface                        $response
     * @param                                          $args
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $swagger = scan($this->appConfig->getRootDir());
        $response->getBody()->write(json_encode($swagger));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
