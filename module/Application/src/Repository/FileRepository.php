<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

use Application\Entity\FileEntity;

class FileRepository extends EntityRepository
{
    public function save(FileEntity $file, $flush = true)
    {
        $em = $this->getEntityManager();

        $em->persist($file);
        if ($flush) {
            $em->flush();
        }
    }
}