<?php

namespace Barkyn\Infrastructure\Http\Actions\Customer;

use Barkyn\Infrastructure\Http\Actions\BaseAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UpdateCustomerAction extends BaseAction
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->withJson($response, []);
    }
}
