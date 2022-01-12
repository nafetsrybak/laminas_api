<?php
namespace Application\Controller\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Form\Annotation\AnnotationBuilder;

use Application\Form\CustomerForm;
use Application\Manager\CustomerManager;
use Application\Resource\Customer\CustomerResource;

class CustomerControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $customerForm = $container->get(CustomerForm::class);
        $customerManager = $container->get(CustomerManager::class);
        $customerResource = $container->get(CustomerResource::class);
        $formBuilder = new AnnotationBuilder;

        return new $requestedName(
            $customerManager,
            $customerForm,
            $customerResource,
            $formBuilder
        );
    }
}
