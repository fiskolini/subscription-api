<?php

use Barkyn\Infrastructure\Http\Actions\Customer;
use Slim\Routing\RouteCollectorProxy;

return function (RouteCollectorProxy $app) {
    $app->group('/customers', function (RouteCollectorProxy $app) {
        $app->get('', Customer\ListCustomersAction::class)->setName('customers-list');

        $app->group('/{user_id}', function (RouteCollectorProxy $app) {
            $app->get('', Customer\SingleCustomerAction::class)->setName('single-customer');
        });
    });
};
