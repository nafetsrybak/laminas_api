<?php
namespace Application\Repository;

use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;

use Application\Entity\OrderEntity;
use Application\DTO\Order\OrderList;

class OrderRepository extends EntityRepository
{
    public static function createListCriteria(OrderList $search)
    {
        $criteria = Criteria::create();

        if ($search->getCustomerName()) {
            $criteria->andWhere(
                Criteria::expr()->contains('c.name', $search->getCustomerName())
            );
        }

        if ($search->getCreatedAtFrom()) {
            $criteria->andWhere(
                Criteria::expr()->gte('o.created_at', $search->getCreatedAtFrom())
            );
        }

        if ($search->getCreatedAtTo()) {
            $dateTime = (new DateTime($search->getCreatedAtTo()))->setTime(24, 0, 0);
            $criteria->andWhere(
                Criteria::expr()->lt('o.created_at', $dateTime)
            );
        }

        return $criteria;
    }

    public function save(OrderEntity $order, $flush = true)
    {
        $em = $this->getEntityManager();

        $em->persist($order);
        if ($flush) {
            $em->flush();
        }
    }

}