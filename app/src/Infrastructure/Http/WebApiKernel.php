<?php

namespace Barkyn\Infrastructure\Http;

use Barkyn\Infrastructure\Http\Middleware;
use Slim\App;


/**
 * @OA\Server(url="http://barkyn.codes/api")
 * @OA\Schemes(format="http")
 * @OA\SecurityScheme(
 *      securityScheme="bearer",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer"
 * )
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Barkyn Subscription API",
 *         @OA\Contact(
 *          email="fiskolini@gmail.com"
 *         )
 *     )
 * )
 */
class WebApiKernel
{
    /**
     * @var App Slim Application
     */
    private App $app;

    /**
     * Kernel constructor.
     *
     * @param App $collectorProxy
     */
    public function __construct(App $collectorProxy)
    {
        $this->app = $collectorProxy;
    }

    /**
     * Get routes to inject
     *
     * @return string[]
     */
    private function routes(): array
    {
        return [
            __DIR__ . '/Routes/customers.php',
            __DIR__ . '/Routes/general.php',
        ];
    }

    /**
     * Get middlewares to inject
     *
     * @return array
     */
    private function middlewares(): array
    {
        return [
            Middleware\CorsEnabler::class,
            Middleware\ErrorHandlerMiddleware::class,
        ];
    }

    /**
     * Run Web application
     */
    public function run()
    {
        $this->app->setBasePath('/api');
        $this->loadMiddleware();
        $this->loadRoutes();

        $this->app->run();
    }

    /**
     * Load routes to the app
     */
    private function loadRoutes()
    {
        foreach ($this->routes() as $router) {
            (include_once $router)($this->app);
        }
    }

    /**
     * Inject middleware to the app
     */
    private function loadMiddleware()
    {
        foreach ($this->middlewares() as $middleware) {
            $this->app->add($middleware);
        }

        // Add the Slim built-in routing middleware
        // to the app middleware stack.
        $this->app->addRoutingMiddleware();
    }
}
