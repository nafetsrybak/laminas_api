<?php
namespace Application\Manager;

use Application\Entity\CustomerEntity;
use Application\DTO\Customer\{
    Customer, CustomerList
};
use Application\Service\CustomerService;

class CustomerManager
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function createCustomer(Customer $customerDto): CustomerEntity
    {
        $customer = $this->customerService->createCustomer($customerDto);

        return $customer;
    }

    public function updateCustomer(Customer $customerDto): CustomerEntity
    {
        $customer = $this->customerService->updateCustomer($customerDto);

        return $customer;
    }

    public function getCustomerList(CustomerList $search)
    {
        $customerList = $this->customerService->getCustomerList($search);

        return $customerList;
    }
}