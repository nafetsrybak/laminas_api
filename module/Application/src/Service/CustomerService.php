<?php
namespace Application\Service;

use DateTime;
use Laminas\Paginator\Paginator;
use Application\DTO\Customer\{
    Customer,
    CustomerList
};
use Application\Entity\CustomerEntity;
use Application\Repository\Adapter\CustomerListAdapter;
use Application\Repository\CustomerRepository;
use Application\Service\Exception\EntityNotFoundException;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function createCustomer(Customer $customerDto)
    {
        $dateTime = new DateTime;
        $customer = new CustomerEntity;

        $customer->setDateCreated($dateTime);
        $customer->setDateUpdated($dateTime);
        $this->fillCustomer($customer, $customerDto);
        $this->customerRepository->save($customer);

        return $customer;
    }

    public function updateCustomer(Customer $customerDto)
    {
        /** @var CustomerEntity|null $customer */
        $customer = $this->customerRepository->find($customerDto->getId());
        
        if (!$customer) {
            throw EntityNotFoundException::fromClassNameAndIdentifier(CustomerEntity::class, $customerDto->getId());
        }

        $dateTime = new DateTime;

        $customer->setDateUpdated($dateTime);
        $this->fillCustomer($customer, $customerDto);
        $this->customerRepository->save($customer);

        return $customer;
    }

    public function getCustomerList(CustomerList $search)
    {
        $adapter = new CustomerListAdapter(
            $this->customerRepository,
            $search
        );
        $paginator = new Paginator($adapter);

        if ($search->getPage()) {
            $paginator->setCurrentPageNumber($search->getPage());
        } else {
            $paginator->setCurrentPageNumber(CustomerListAdapter::DEFAULT_FISRT_PAGE);
        }
        $paginator->setDefaultItemCountPerPage(CustomerListAdapter::DEFAULT_COUNT_PER_PAGE);

        return $paginator;
    }

    protected function fillCustomer(CustomerEntity $customerEntity, Customer $customer)
    {
        $customerEntity
            ->setName($customer->getName())
            ->setSurname($customer->getSurname())
            ->setEmail($customer->getEmail())
            ->setPhone($customer->getPhone())
            ->setDiscount($customer->getPhone())
            ->setDiscount($customer->getDiscount())
        ;
    }
}