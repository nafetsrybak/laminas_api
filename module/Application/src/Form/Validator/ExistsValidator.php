<?php
namespace Application\Form\Validator;

class ExistsValidator extends NotExistsValidator
{
    public const ERROR_NO_RECORD_FOUND = 'noRecordFound';

    /**
     * @var array<string, string> Message templates
     */
    protected $messageTemplates = [
        self::ERROR_NO_RECORD_FOUND => 'No record matching the input was found',
    ];

    public function isValid($value)
    {
        $search = array_fill_keys($this->fields, $value);
        $res = $this->em->getRepository($this->class)->findOneBy($search);

        $valid = true;
        if (!$res) {
            $valid = false;
            $this->error(self::ERROR_NO_RECORD_FOUND, $value);
        }

        return $valid;
    }
}