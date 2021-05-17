<?php

namespace Barkyn\Infrastructure\Http\Actions\Customer;

use Barkyn\Domain\Services\Customer\CustomerLoaderService;
use Barkyn\Infrastructure\Http\Actions\BaseAction;
use DI\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

/**
 * @OA\Get(
 *     tags={"customer"},
 *     path="/customers/{id}",
 *     operationId="getCustomer",
 *     summary="Get customer by it's id",
 *     security={
 *      {"bearer": {}},
 *     },
 *     @OA\Response(
 *      response="200",
 *      description="Get customer",
 *      @OA\Schema(ref="#/components/schemas/CustomerSchema")
 *     ),
 *     @OA\Response(
 *      response="404",
 *      description="Customer not found"
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
class SingleCustomerAction extends BaseAction
{

    /**
     * @var CustomerLoaderService
     */
    private CustomerLoaderService $customerService;

    /**
     * ListCustomersAction constructor.
     *
     * @param CustomerLoaderService $customerLoaderService
     */
    public function __construct(CustomerLoaderService $customerLoaderService)
    {
        $this->customerService = $customerLoaderService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     *
     * @return ResponseInterface
     * @throws HttpBadRequestException
     * @throws NotFoundException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        if (!array_key_exists('id', $args)) {
            throw new HttpBadRequestException($request, "Required param 'id'");
        }

        $customer = $this->customerService->fetchById($args['id']);

        if (empty($customer)){
            throw new NotFoundException("User {$args['id']} not found");
        }

        return $this->withJson($response, $customer);
    }
}
