<?php


namespace Barkyn\Domain\Services\Customer;

use Barkyn\Domain\Entities\Customer\CustomerEntity;
use Barkyn\Domain\Repositories\Customer\CustomerRepository;

class CustomerLoaderService
{
    /**
     * @var CustomerRepository $customerRepository
     */
    private CustomerRepository $customerRepository;

    /**
     * CustomerLoaderService constructor.
     *
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Fetch all customers, including the ones deleted
     *
     * @return CustomerEntity[]
     */
    public function fetchAll(?int $limit = null): array
    {
        return $this->customerRepository
            ->findAll(true, false, $limit)
            ->toArray();
    }

    /**
     * @return CustomerEntity[]
     */
    public function fetchAllActive(?int $limit = null): array
    {
        return $this->customerRepository
            ->findAll(true, true, $limit)
            ->toArray();
    }
}
