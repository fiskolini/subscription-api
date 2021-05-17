<?php


namespace Barkyn\Infrastructure\Http\Schemas\Customer;

/**
 * @OA\Schema(
 *     title="Customer",
 *     description="A Customer model."
 * )
 */
class CustomerSchema
{
    /**
     * @OA\Property(type="integer", readOnly=true, example=1)
     */
    private int $id;

    /**
     * @OA\Property(type="integer", example=25)
     */
    private int $discount;

    /**
     * @OA\Property(type="string", example="2021-05-17 00:00:00")
     */
    private string $created_at;

    /**
     * @OA\Property(type="string", example="2021-05-17 00:00:00")
     */
    private string $updated_at;

    /**
     * @OA\Property(type="string", example="2021-05-17 00:00:00")
     */
    private string $deleted_at;
}
