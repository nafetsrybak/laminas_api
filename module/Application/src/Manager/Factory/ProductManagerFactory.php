<?php
namespace Application\Manager\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Service\ProductService;

class ProductManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $productService = $container->get(ProductService::class);

        return new $requestedName($productService);
    }
}
