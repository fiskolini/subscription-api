<?php


namespace Barkyn\Domain\Services\Customer;

use Barkyn\Domain\DTO\Customer\CustomerDto;
use Barkyn\Persistence\Exceptions\DatabaseException;
use Barkyn\Persistence\Repositories\Customer\CustomerRepository;

class CustomerSaverService
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
     * @param CustomerDto $customerDto
     *
     * @return array
     * @throws DatabaseException
     */
    public function persist(CustomerDto $customerDto): array
    {
        return $this->customerRepository->persist($customerDto)->toArray();
    }
}
