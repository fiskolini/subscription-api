<?php

use Barkyn\Infrastructure\Http\Actions\Customer;
use Barkyn\Infrastructure\Http\Middleware\DummyAuthMiddleware;
use Slim\Routing\RouteCollectorProxy;

return function (RouteCollectorProxy $app) {
    $app->group('/customers', function (RouteCollectorProxy $app) {
        $app->get('', Customer\ListCustomersAction::class)->setName('customers-list');

        $app->group('/{id}', function (RouteCollectorProxy $app) {
            $app->get('', Customer\SingleCustomerAction::class)->setName('single-customer');
        });

        $app->post('', Customer\CreateCustomersAction::class)->setName('create-customer');

        // TODO
        $app->delete('/{id}', Customer\DeleteCustomerAction::class)->setName('delete-customer');
        $app->patch('/{id}', Customer\CreateCustomersAction::class)->setName('delete-customer');

    })->add(DummyAuthMiddleware::class);
};
