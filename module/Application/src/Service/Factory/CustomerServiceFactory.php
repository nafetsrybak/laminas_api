<?php
namespace Application\Service\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Entity\CustomerEntity;

class CustomerServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get('doctrine.entitymanager.orm_default');
        $customerRepository = $em->getRepository(CustomerEntity::class);

        return new $requestedName($customerRepository);
    }
}