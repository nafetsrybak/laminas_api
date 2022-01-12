<?php
namespace Application\Manager\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Service\FileService;

class FileManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $fileService = $container->get(FileService::class);

        return new $requestedName(
            $fileService
        );
    }
}
