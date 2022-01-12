<?php
namespace Application\Controller\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Manager\OrderManager;
use Application\Resource\Pdf\PdfResource;

class PdfControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $orderManager = $container->get(OrderManager::class);
        $pdfResource = $container->get(PdfResource::class);

        return new $requestedName(
            $orderManager,
            $pdfResource
        );
    }
}