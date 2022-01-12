<?php
namespace Application\Repository\Adapter;

use Laminas\Paginator\Adapter\AdapterInterface;

use Application\Repository\ProductRepository;
use Application\DTO\Product\ProductList;
use Doctrine\ORM\QueryBuilder;

class ProductListAdapter implements AdapterInterface
{
    const DEFAULT_COUNT_PER_PAGE = 10;

    const DEFAULT_FISRT_PAGE = 1;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var ProductList
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
        ProductRepository $productRepository,
        ProductList $search
    )
    {
        $this->productRepository = $productRepository;
        $this->search = $search;
    }

    public function count(): int
    {
        if (isset($this->count)) {
            return $this->count;
        }

        $res = $this->initQB()
            ->select('COUNT(p.id)')
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
            ->select('p, i')
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

        $qb = $this->productRepository->createQueryBuilder('p');

        $qb
            ->leftJoin('p.image', 'i')
        ;

        $qb->addCriteria(
            ProductRepository::createListCriteria($this->search)
        );

        return $this->qb = $qb;
    }
}