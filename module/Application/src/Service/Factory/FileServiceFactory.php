<?php
namespace Application\Service\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Entity\FileEntity;

class FileServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get('doctrine.entitymanager.orm_default');
        $fileRepository = $em->getRepository(FileEntity::class);

        return new $requestedName($fileRepository);
    }
}