<?php

namespace Barkyn\Infrastructure\Http\Actions\Customer;

use Barkyn\Domain\DTO\Customer\CustomerDto;
use Barkyn\Domain\Services\Customer\CustomerSaverService;
use Barkyn\Infrastructure\Http\Actions\BaseAction;
use Barkyn\Persistence\Exceptions\DatabaseException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

/**
 * @OA\Post(
 *     tags={"customer"},
 *     path="/customers",
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
class CreateCustomersAction extends BaseAction
{
    /**
     * @var CustomerSaverService
     */
    private CustomerSaverService $customerService;

    /**
     * ListCustomersAction constructor.
     *
     * @param CustomerSaverService $customerLoaderService
     */
    public function __construct(CustomerSaverService $customerLoaderService)
    {
        $this->customerService = $customerLoaderService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @return ResponseInterface
     * @throws HttpBadRequestException
     * @throws DatabaseException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $body = $request->getParsedBody();
        $errors = [];

        if (!array_key_exists('discount', $body)) {
            array_push($errors, 'discount');
        }

        if (!empty($errors)) {
            throw new HttpBadRequestException($request, "Missing fields. " . implode(",", $errors));
        }

        $dto = new CustomerDto(intval($body['discount']), $body['user_id'] ?? null);

        $createdCustomer = $this->customerService->persist($dto);

        return $this->withJson($response, $createdCustomer);
    }
}
