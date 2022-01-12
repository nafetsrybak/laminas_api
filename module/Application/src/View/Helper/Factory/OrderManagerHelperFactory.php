<?php
namespace Application\View\Helper\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Manager\OrderManager;

class OrderManagerHelperFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $orderManager = $container->get(OrderManager::class);

        return new $requestedName($orderManager);
    }
}
