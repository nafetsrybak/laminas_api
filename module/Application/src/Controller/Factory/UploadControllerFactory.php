<?php
namespace Application\Controller\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Form\Annotation\AnnotationBuilder;

use Application\Manager\FileManager;
use Application\Resource\Upload\UploadResource;

class UploadControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formBuilder = new AnnotationBuilder;
        $fileManager = $container->get(FileManager::class);
        $uploadResource = $container->get(UploadResource::class);

        return new $requestedName(
            $formBuilder,
            $fileManager,
            $uploadResource
        );
    }
}