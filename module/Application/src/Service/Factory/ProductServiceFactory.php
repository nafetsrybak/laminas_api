<?php
namespace Application\Service\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Entity\ProductEntity;
use Application\Entity\FileEntity;

class ProductServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get('doctrine.entitymanager.orm_default');
        $productRepository = $em->getRepository(ProductEntity::class);
        $fileRepository = $em->getRepository(FileEntity::class);

        return new $requestedName($productRepository, $fileRepository);
    }
}