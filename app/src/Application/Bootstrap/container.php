<?php

use Barkyn\Application\Configuration\DbConfig;
use Barkyn\Application\Configuration\Environment;
use Barkyn\Domain\Repository\Customer\CustomerRepository;
use Barkyn\Infrastructure\Config\ConfigLoader;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Selective\Validation\Encoder\JsonEncoder;
use Selective\Validation\Middleware\ValidationExceptionMiddleware;
use Selective\Validation\Transformer\ErrorDetailsResultTransformer;
use Slim\App;
use Slim\Factory\AppFactory;

return [
    // Slim container
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        return AppFactory::create();
    },

    ConfigLoader::class => function () {
        return new ConfigLoader(realpath(__DIR__ . '/../../../'));
    },

    Environment::class => function (ContainerInterface $container) {
        return new Environment($container->get(ConfigLoader::class));
    },

    DbConfig::class                 => function (ContainerInterface $container) {
        return new DbConfig($container->get(ConfigLoader::class));
    },


    // HTTP factories
    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getResponseFactory();
    },

    ServerRequestFactoryInterface::class => function () {
        return new Psr17Factory();
    },

    ValidationExceptionMiddleware::class => function (ContainerInterface $container) {
        $factory = $container->get(ResponseFactoryInterface::class);

        return new ValidationExceptionMiddleware(
            $factory,
            new ErrorDetailsResultTransformer(),
            new JsonEncoder()
        );
    }
];
