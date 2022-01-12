<?php
namespace Application\Repository\Adapter;

use Doctrine\ORM\QueryBuilder;
use Laminas\Paginator\Adapter\AdapterInterface;

use Application\DTO\Customer\CustomerList;
use Application\Repository\{
    CustomerRepository
};

class CustomerListAdapter implements AdapterInterface
{
    const DEFAULT_COUNT_PER_PAGE = 10;

    const DEFAULT_FISRT_PAGE = 1;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var CustomerList
     */
    protected $search;

    /**
     * @var int|null
     */
    protected $count = null;

    /**
     * @var QueryBuilder
     */
    protected $qb;

    public function __construct(
        CustomerRepository $customerRepository,
        CustomerList $search
    )
    {
        $this->customerRepository = $customerRepository;
        $this->search = $search;
    }

    public function count(): int
    {
        if (isset($this->count)) {
            return $this->count;
        }

        $res = $this->initQB()
            ->select('COUNT_OVER(c.id)')
            ->setFirstResult(NULL)
            ->setMaxResults(1)
            ->getQuery()->getResult()
        ;

        if (empty($res)) {
            return $this->count = 0;
        }

        return $this->count = (int)$res[0][1];
    }

    public function getItems($offset, $itemCountPerPage)
    {
        $res = $this->initQB()
            ->select('c as customer, MAX(o.created_at) as lastOrderDate')
            ->setFirstResult($offset)
            ->setMaxResults($itemCountPerPage)
            ->getQuery()
            ->getResult()
        ;

        return $res;
    }

    protected function initQB()
    {
        if ($this->qb) {
            return $this->qb;
        }

        $qb = $this->customerRepository->createQueryBuilder('c');

        $qb
            ->leftJoin('c.orders', 'o')
            ->groupBy('c.id')
        ;

        $qb->addCriteria(
            CustomerRepository::createListCriteria($this->search)
        );

        return $this->qb = $qb;
    }
}