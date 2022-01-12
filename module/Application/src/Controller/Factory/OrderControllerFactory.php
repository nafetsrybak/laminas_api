<?php
namespace Application\Controller\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Form\Annotation\AnnotationBuilder;
use Laminas\Validator\ValidatorChain;
use Laminas\Validator\ValidatorPluginManager;

use Application\Manager\OrderManager;
use Application\Resource\Order\OrderResource;

class OrderControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $orderManager = $container->get(OrderManager::class);
        $orderResource = $container->get(OrderResource::class);
        $formBuilder = new AnnotationBuilder;

        $validatorChain = new ValidatorChain;
        $validatorChain->setPluginManager($container->get(ValidatorPluginManager::class));

        $formBuilder
            ->getFormFactory()
            ->getInputFilterFactory()
            ->setDefaultValidatorChain($validatorChain)
        ;

        return new $requestedName(
            $orderManager,
            $orderResource,
            $formBuilder
        );
    }
}
