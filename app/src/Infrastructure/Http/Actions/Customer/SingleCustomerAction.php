<?php

namespace Barkyn\Infrastructure\Http\Actions\Customer;

use Barkyn\Infrastructure\Http\Actions\BaseAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SingleCustomerAction extends BaseAction
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        dd($this->param($args, 'user_id'));
        return $this->withJson($response, ['response' => 'hello world!']);
    }
}
