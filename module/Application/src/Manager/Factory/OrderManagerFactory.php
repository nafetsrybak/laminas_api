<?php
namespace Application\Manager\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Service\OrderService;

class OrderManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $orderService = $container->get(OrderService::class);

        return new $requestedName(
            $orderService
        );
    }
}
