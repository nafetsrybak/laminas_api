<?php
namespace Application\Form\Validator;

use Laminas\Validator\AbstractValidator;
use Doctrine\ORM\EntityManager;

class NotExistsValidator extends AbstractValidator
{
    public const ERROR_RECORD_FOUND = 'recordFound';

    /**
     * @var array<string, string> Message templates
     */
    protected $messageTemplates = [
        self::ERROR_RECORD_FOUND => 'A record matching the input was found',
    ];

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var array
     */
    protected $fields;

    /**
     * Constructor.
     */
    public function __construct($options = null)
    {
        parent::__construct($options);

        if (is_array($options)) {

            if (
                isset($options['em']) &&
                $options['em'] instanceof EntityManager
            ) {
                $this->em = $options['em'];
            } else {
                throw new \InvalidArgumentException(
                    'Please provide Entity Manager instance of class: "' . EntityManager::class . '"!'
                );
            }

            if (
                isset($options['class']) &&
                is_string($options['class'])
            ) {
                $this->class = $options['class'];
            } else {
                throw new \InvalidArgumentException('Please provide class name!');
            }

            if (
                isset($options['fields']) &&
                is_array($options['fields'])
            ) {
                $this->fields = $options['fields'];
            } else {
                throw new \InvalidArgumentException('Please provide fields!');
            }
        } else {
            throw new \InvalidArgumentException('Please provide options for validator!');
        }
    }

    public function isValid($value)
    {
        $search = array_fill_keys($this->fields, $value);
        $res = $this->em->getRepository($this->class)->findOneBy($search);

        $valid = true;
        if ($res) {
            $valid = false;
            $this->error(self::ERROR_RECORD_FOUND, $value);
        }

        return $valid;
    }
}