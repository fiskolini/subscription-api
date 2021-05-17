<?php

use Barkyn\Infrastructure\Http\Actions\OpenApiAction;
use Slim\App;

return function (App $app) {
    /**
     * @OA\Get(
     *     path="/openapi",
     *     tags={"documentation"},
     *     summary="OpenAPI JSON File that describes the API",
     *     @OA\Response(response="200", description="OpenAPI Description File"),
     * )
     */
    $app->get('/openapi', OpenApiAction::class)->setName('openapi');
};
