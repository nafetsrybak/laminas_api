<?php
namespace Application\Form;

use Doctrine\ORM\EntityManager;
use Laminas\Form\Form;
use Laminas\Filter\{
    StringTrim,
    StripTags,
    StripNewlines,
    ToFloat
};

use Laminas\Validator\{
    NotEmpty,
    StringLength,
    EmailAddress,
    Between
};
use Application\Form\Validator\NotExistsValidator;
use Application\Entity\CustomerEntity;

class CustomerForm extends Form
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(
        $em
    )
    {
        parent::__construct('customer-form');

        $this->em = $em;

        // add ellements
        $this->addElements();

        // add filters and validation rules
        $this->addInputFilter();        
    }

    protected function addElements()
    {
        $this->add([
            'name' => 'name'
        ]);
        $this->add([
            'name' => 'surname'
        ]);
        $this->add([
            'name' => 'email'
        ]);
        $this->add([
            'name' => 'phone'
        ]);
        $this->add([
            'name' => 'discount'
        ]);
    }

    protected function addInputFilter()
    {
        $inputFilter = $this->getInputFilter();

        $inputFilter->add([
            'name'     => 'name',
            'filters'  => [
                ['name' => StringTrim::class],
                ['name' => StripNewlines::class],
                ['name' => StripTags::class]
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'min' => 1,
                        'max' => 191
                    ]
                ]
            ]
        ]);
        $inputFilter->add([
            'name'     => 'surname',
            'filters'  => [
                ['name' => StringTrim::class],
                ['name' => StripNewlines::class],
                ['name' => StripTags::class]
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'min' => 1,
                        'max' => 191
                    ]
                ]
            ]
        ]);
        $inputFilter->add([
            'name'     => 'email',
            'filters'  => [
                ['name' => StringTrim::class],
                ['name' => StripNewlines::class],
                ['name' => StripTags::class]
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true
                ],
                [
                    'name' => StringLength::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'min' => 1,
                        'max' => 191
                    ]
                ],
                [
                    'name' => EmailAddress::class,
                    'break_chain_on_failure' => true,
                ],
                [
                    'name' => NotExistsValidator::class,
                    'options' => [
                        'em' => $this->em,
                        'class' => CustomerEntity::class,
                        'fields' => ['email']
                    ]
                ]
            ]
        ]);
        $inputFilter->add([
            'name'     => 'phone',
            'filters'  => [
                ['name' => StringTrim::class],
                ['name' => StripNewlines::class],
                ['name' => StripTags::class]
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'min' => 1,
                        'max' => 191
                    ]
                ]
            ]
        ]);
        $inputFilter->add([
            'name'     => 'discount',
            'filters'  => [
                ['name' => ToFloat::class]
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true
                ],
                [
                    'name' => Between::class,
                    'options' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ]
            ]
        ]);
    }
}