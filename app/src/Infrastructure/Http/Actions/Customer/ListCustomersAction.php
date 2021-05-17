<?php

namespace Barkyn\Infrastructure\Http\Actions\Customer;

use Barkyn\Domain\Services\Customer\CustomerLoaderService;
use Barkyn\Infrastructure\Http\Actions\BaseAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @OA\Get(
 *     tags={"customer"},
 *     path="/customers",
 *     operationId="getCustomers",
 *     @OA\Response(
 *      response="200",
 *      description="List all customers",
 *      @OA\JsonContent(
 *          type="array",
 *          @OA\Items(ref="#Customer")
 *      )
 *     )
 * )
 */
class ListCustomersAction extends BaseAction
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
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $limit = intval($request->getQueryParams()['limit']) ?? null;
        $customers = $this->customerService->fetchAll($limit);

        return $this->withJson($response, $customers);
    }
}
