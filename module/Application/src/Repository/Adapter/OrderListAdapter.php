<?php
namespace Application\Repository\Adapter;

use Laminas\Paginator\Adapter\AdapterInterface;

use Application\Repository\OrderRepository;
use Application\DTO\Order\OrderList;
use Doctrine\ORM\QueryBuilder;

class OrderListAdapter implements AdapterInterface
{
    const DEFAULT_COUNT_PER_PAGE = 10;

    const DEFAULT_FISRT_PAGE = 1;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var OrderList
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
        OrderRepository $orderRepository,
        OrderList $search
    )
    {
        $this->orderRepository = $orderRepository;
        $this->search = $search;
    }

    public function count(): int
    {
        if (isset($this->count)) {
            return $this->count;
        }

        $res = $this->initQB()
            ->select('COUNT(o.id)')
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
            ->select('o, c')
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

        $qb = $this->orderRepository->createQueryBuilder('o');

        $qb
            ->leftJoin('o.customer', 'c')
        ;

        $qb->addCriteria(
            OrderRepository::createListCriteria($this->search)
        );

        return $this->qb = $qb;
    }
}