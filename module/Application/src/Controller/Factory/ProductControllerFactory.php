<?php
namespace Application\Controller\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Form\Annotation\AnnotationBuilder;
use Laminas\Validator\ValidatorChain;
use Laminas\Validator\ValidatorPluginManager;

use Application\Manager\ProductManager;
use Application\Resource\Product\ProductResource;

class ProductControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $productManager = $container->get(ProductManager::class);
        $productResource = $container->get(ProductResource::class);
        $formBuilder = new AnnotationBuilder;

        $validatorChain = new ValidatorChain;
        $validatorChain->setPluginManager($container->get(ValidatorPluginManager::class));

        $formBuilder
            ->getFormFactory()
            ->getInputFilterFactory()
            ->setDefaultValidatorChain($validatorChain)
        ;

        return new $requestedName(
            $productManager,
            $productResource,
            $formBuilder
        );
    }
}