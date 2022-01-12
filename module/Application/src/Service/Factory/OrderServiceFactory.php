<?php
namespace Application\Service\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Entity\OrderEntity;
use Application\Entity\OrderItemEntity;
use Application\Entity\ProductEntity;
use Application\Entity\CustomerEntity;

class OrderServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get('doctrine.entitymanager.orm_default');
        $orderRepository = $em->getRepository(OrderEntity::class);
        $orderItemRepository = $em->getRepository(OrderItemEntity::class);
        $productRepository = $em->getRepository(ProductEntity::class);
        $customerRepository = $em->getRepository(CustomerEntity::class);

        return new $requestedName(
            $orderRepository,
            $orderItemRepository,
            $productRepository,
            $customerRepository
        );
    }
}