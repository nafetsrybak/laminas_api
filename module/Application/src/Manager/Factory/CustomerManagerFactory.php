<?php
namespace Application\Manager\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Service\CustomerService;

class CustomerManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $customerService = $container->get(CustomerService::class);

        return new $requestedName($customerService);
    }
}
