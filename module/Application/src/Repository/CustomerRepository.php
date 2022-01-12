<?php
namespace Application\Repository;

use DateTime;
use Application\DTO\Customer\CustomerList;
use Application\Entity\CustomerEntity;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;

class CustomerRepository extends EntityRepository
{
    public static function createListCriteria(CustomerList $search)
    {
        $criteria = Criteria::create();

        if ($search->getName()) {
            $criteria->where(
                Criteria::expr()->contains('c.name', $search->getName())
            );
        }

        if ($search->getSurname()) {
            $criteria->andWhere(
                Criteria::expr()->contains('c.surname', $search->getSurname())
            );
        }

        if ($search->getLastOrderDateFrom()) {
            $criteria->andWhere(
                Criteria::expr()->gte('o.created_at', $search->getLastOrderDateFrom())
            );
        }

        if ($search->getLastOrderDateTo()) {
            $dateTime = (new DateTime($search->getLastOrderDateTo()))->setTime(24, 0, 0);
            $criteria->andWhere(
                Criteria::expr()->lt('o.created_at', $dateTime)
            );
        }

        return $criteria;
    }

    public function save(CustomerEntity $customer, $flush = true)
    {
        $em = $this->getEntityManager();

        $em->persist($customer);
        if ($flush) {
            $em->flush();
        }
    }
}