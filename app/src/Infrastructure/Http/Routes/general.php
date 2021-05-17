<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    $app->options('/{routes:.+}', function (ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        return $response;
    });
};
