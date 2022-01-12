<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;

use Application\DTO\Product\ProductList;
use Application\Entity\ProductEntity;

class ProductRepository extends EntityRepository
{
    public static function createListCriteria(ProductList $search)
    {
        $criteria = Criteria::create();

        if ($search->getNumber()) {
            $criteria->where(
                Criteria::expr()->contains('p.number', $search->getNumber())
            );
        }

        if ($search->getPriceFrom()) {
            $criteria->andWhere(
                Criteria::expr()->gte('p.price', $search->getPriceFrom())
            );
        }

        if ($search->getPriceTo()) {
            $criteria->andWhere(
                Criteria::expr()->lte('p.price', $search->getPriceTo())
            );
        }

        return $criteria;
    }

    public function save(ProductEntity $product, $flush = true)
    {
        $em = $this->getEntityManager();

        $em->persist($product);
        if ($flush) {
            $em->flush();
        }
    }

    public function delete(ProductEntity $product, $flush = true)
    {
        $em = $this->getEntityManager();

        $em->remove($product);

        if ($flush) {
            $em->flush();
        }
    }
}