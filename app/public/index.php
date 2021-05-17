<?php

use Barkyn\Application\DiContainer;
use Barkyn\Application\WebApp;

/*
|--------------------------------------------------------------------------
| Register the Loader
|--------------------------------------------------------------------------
|
| The first stage of this application is to autoload all classmap
| in order to get access to all classes (registered).
| Composer provides a convenient class loader for our application.
|
*/

require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Initialize Container
|--------------------------------------------------------------------------
|
| Loads all dependencies in a container, to be used later.
|
*/

try {
    $container = (new DiContainer())->build();
} catch (Exception $exception) {
    exit("Error running application. {$exception->getMessage()}");
}

/*
|--------------------------------------------------------------------------
| Load application's kernel
|--------------------------------------------------------------------------
|
| Load up this application so that we can run it and send
| the responses back to the console and delight our users.
|
*/
/** @var WebApp $webApp */
$webApp = $container->get(WebApp::class);

/*
|--------------------------------------------------------------------------
| Run, phorrest, run!
|--------------------------------------------------------------------------
|
| Run the application and delight our users
|
*/
$webApp->serve();

