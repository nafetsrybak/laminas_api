<?php
namespace Application\Form\Factory;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

use Application\Form\CustomerForm;
use Application\DTO\Customer\Customer;
use Laminas\Hydrator\ClassMethodsHydrator;

class CustomerFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $customer = new Customer;
        $em = $container->get('doctrine.entitymanager.orm_default');
        $form = new CustomerForm(
            $em
        );
        $hydrator = $container->get(ClassMethodsHydrator::class);

        $form->setHydrator($hydrator);
        $form->bind($customer);
        return $form;
    }
}