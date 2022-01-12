<?php
namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

use Laminas\Validator\ValidatorPluginManager;
use Psr\Container\ContainerInterface;

use Application\Form\Validator\ExistsValidator;
use Application\Form\Validator\Factory\ExistsValidatorFactory;

return [
    'router' => [
        'routes' => [
            'api' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/api'
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'customer' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/customer',
                            'defaults' => [
                                'controller' => Controller\CustomerController::class
                            ]
                        ]
                    ],
                    'product' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/product',
                            'defaults' => [
                                'controller' => Controller\ProductController::class
                            ]
                        ]
                    ],
                    'order' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/order',
                            'defaults' => [
                                'controller' => Controller\OrderController::class
                            ]
                        ]
                    ],
                    'upload' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/upload/[:action]',
                            'defaults' => [
                                'controller' => Controller\UploadController::class
                            ]
                        ]
                    ],
                    'pdf' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/pdf/:id',
                            'defaults' => [
                                'controller' => Controller\PdfController::class,
                                'action' => 'getOrderPdf'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\CustomerController::class => Controller\Factory\CustomerControllerFactory::class,
            Controller\ProductController::class => Controller\Factory\ProductControllerFactory::class,
            Controller\OrderController::class => Controller\Factory\OrderControllerFactory::class,
            Controller\UploadController::class => Controller\Factory\UploadControllerFactory::class,
            Controller\PdfController::class => Controller\Factory\PdfControllerFactory::class,
        ]
    ],
    'service_manager' => [
        'factories' => [
            Service\CustomerService::class => Service\Factory\CustomerServiceFactory::class,
            Service\ProductService::class => Service\Factory\ProductServiceFactory::class,
            Service\OrderService::class => Service\Factory\OrderServiceFactory::class,
            Service\FileService::class => Service\Factory\FileServiceFactory::class,
            Service\Pdf\PdfService::class => InvokableFactory::class,

            Manager\CustomerManager::class => Manager\Factory\CustomerManagerFactory::class,
            Manager\ProductManager::class => Manager\Factory\ProductManagerFactory::class,
            Manager\OrderManager::class => Manager\Factory\OrderManagerFactory::class,
            Manager\FileManager::class => Manager\Factory\FileManagerFactory::class,

            Form\CustomerForm::class => Form\Factory\CustomerFormFactory::class,

            Resource\Customer\CustomerResource::class => InvokableFactory::class,
            Resource\Product\ProductResource::class => InvokableFactory::class,
            Resource\Order\OrderResource::class => InvokableFactory::class,
            Resource\Upload\UploadResource::class => InvokableFactory::class,
            Resource\Pdf\PdfResource::class => Resource\Pdf\Factory\PdfResourceFactory::class,

            \Laminas\Hydrator\ClassMethodsHydrator::class => InvokableFactory::class,

            ValidatorPluginManager::class => function(ContainerInterface $container, $requestedName) {
                return new ValidatorPluginManager($container);
            },
        ]
    ],
    'validators' => [
        'factories' => [
            ExistsValidator::class => ExistsValidatorFactory::class,
        ]
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\OrderManagerHelper::class => View\Helper\Factory\OrderManagerHelperFactory::class,
            View\Helper\RoundHelper::class => InvokableFactory::class,
        ],
        'aliases' => [
            'round' => View\Helper\RoundHelper::class,
            'orderManager' => View\Helper\OrderManagerHelper::class,
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]
];
