<?php


namespace Barkyn\Persistence\Repositories\Customer;


use Barkyn\Domain\DTO\Customer\CustomerDto;
use Barkyn\Domain\Entities\Customer\CustomerEntity;
use Barkyn\Persistence\Exceptions\DatabaseException;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;

class CustomerRepository
{
    /**
     * @param int  $id
     * @param bool $withUserRelation
     * @param bool $onlyActive
     *
     * @return CustomerEntity
     */
    public function fetchById(int $id, bool $withUserRelation = false, bool $onlyActive = true): ?CustomerEntity
    {
        $query = $onlyActive ? CustomerEntity::query() : CustomerEntity::withTrashed();

        if ($withUserRelation) {
            $query->with('user');
        }

        return $query->find($id);
    }

    /**
     * Finds all customers
     *
     * @param bool     $withUserRelation
     * @param bool     $onlyActive
     * @param int|null $limit
     *
     * @return Collection
     */
    public function findAll(bool $withUserRelation = false, bool $onlyActive = true, ?int $limit = null): Collection
    {
        // Apply active filter to fetch only required customers
        $query = $onlyActive ? CustomerEntity::query() : CustomerEntity::withTrashed();

        if ($withUserRelation) {
            $query->with('user');
        }

        if (is_int($limit) && $limit > 0) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * @param CustomerDto $dto
     *
     * @return CustomerEntity
     * @throws DatabaseException
     */
    public function persist(CustomerDto $dto): CustomerEntity
    {
        DB::beginTransaction();

        try {
            $entity = new CustomerEntity([
                'discount' => $dto->getDiscount()
            ]);

            if (is_int($dto->getUserId())) {
                $entity->user_id = $dto->getUserId();
            }

            $entity->save();

            DB::commit();

            return $entity;
        } catch (QueryException $exception) {
            DB::rollBack();
            throw new DatabaseException();
        }


    }
}
