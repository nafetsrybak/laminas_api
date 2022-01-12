<?php
namespace Application\Form\InputFilter;

use Laminas\InputFilter\CollectionInputFilter as LaminasCollectionInputFilter;

class CollectionInputFilter extends LaminasCollectionInputFilter
{
    /**
     * @inheritDoc
     */
    public function isValid($context = null)
    {
        $this->collectionMessages = [];
        $inputFilter              = $this->getInputFilter();
        $valid                    = true;

        if ($this->getCount() < 1 && $this->isRequired) {
            $this->collectionMessages[] = $this->prepareRequiredValidationFailureMessage();
            $valid                      = false;
        }

        if (count($this->data) < $this->getCount()) {
            $valid = false;
        }

        if (! $this->data) {
            $this->clearValues();
            $this->clearRawValues();

            return $valid;
        }

        foreach ($this->data as $key => $data) {
            $inputFilter->setData([
                $key => $data
            ]);

            if (null !== $this->validationGroup) {
                $inputFilter->setValidationGroup([
                    $key => $this->validationGroup[$key]
                ]);
            }

            if ($inputFilter->isValid($context)) {
                $this->validInputs[$key] = $inputFilter->getValidInput()[$key];
            } else {
                $valid                          = false;
                $this->collectionMessages[$key] = $inputFilter->getMessages()[$key];
                $this->invalidInputs[$key]      = $inputFilter->getInvalidInput()[$key];
            }

            $this->collectionValues[$key]    = $inputFilter->getValues()[$key];
            $this->collectionRawValues[$key] = $inputFilter->getRawValues()[$key];
        }

        return $valid;
    }   
}