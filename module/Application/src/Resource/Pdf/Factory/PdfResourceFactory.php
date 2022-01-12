<?php
namespace Application\Resource\Pdf\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Service\Pdf\PdfService;

class PdfResourceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $viewRenderer = $container->get('ViewRenderer');
        $pdfService = $container->get(PdfService::class);

        return new $requestedName(
            $viewRenderer,
            $pdfService
        );
    }
}
