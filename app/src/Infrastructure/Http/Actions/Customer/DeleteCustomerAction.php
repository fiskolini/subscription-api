<?php

namespace Barkyn\Infrastructure\Http\Actions\Customer;

use Barkyn\Infrastructure\Http\Actions\BaseAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


/**
 * @OA\Delete (
 *     tags={"customer"},
 *     path="/customers/{id}",
 *     operationId="createCustomer",
 *     summary="Create a newcustomer",
 *     security={
 *      {"bearer": {}},
 *     },
 *     @OA\RequestBody(
 *      request="Customer",
 *      description="User Id to relate to users",
 *      @OA\JsonContent(ref="#/components/schemas/CustomerSchema"),
 *      required=true
 *     ),
 *     @OA\Response(
 *      response="200",
 *      description="Created customer",
 *      @OA\JsonContent(ref="#/components/schemas/CustomerSchema")
 *     ),
 *     @OA\Response(
 *      response="401",
 *      description="Unauthenticated",
 *      @OA\JsonContent(
 *          type="string",
 *          @OA\Property(property="message", type="string", example="Not authorized"),
 *      )
 *     )
 * )
 */
class DeleteCustomerAction extends BaseAction
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
