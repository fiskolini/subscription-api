<?php


namespace Barkyn\Domain\Repositories\Customer;


use Barkyn\Domain\Entities\Customer\CustomerEntity;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository
{
    /**
     * Finds all customers
     *
     * @param bool     $withUserRelation
     * @param bool     $onlyActive
     * @param int|null $limit
     *
     * @return Collection
     */
    public function findAll(bool $withUserRelation = false, bool $onlyActive = true, int $limit = null): Collection
    {
        // Apply active filter to fetch only required customers
        if ($onlyActive) {
            $query = CustomerEntity::query();
        } else {
            $query = CustomerEntity::withTrashed();
        }

        if ($withUserRelation) {
            $query->with('user');
        }

        return $query->limit($limit)->get();
    }
}
