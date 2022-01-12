<?php
namespace Application\Form;

use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Form\Form;
use Laminas\Filter\File\RenameUpload;
use Laminas\Validator\File\{
    ExcludeExtension,
    IsImage,
    UploadFile
};
use Laminas\InputFilter\FileInput;
use Laminas\Form\Element\File;

use Application\DTO\Image\ImageFile;
use Application\Service\File\Traits\Path;

class ImageFileForm extends Form
{
    use Path;

    public function __construct()
    {
        parent::__construct('image-file-form');

        // add ellements
        $this->addElements();

        // add filters and validation rules
        $this->addInputFilter();

        $hydrator = new ClassMethodsHydrator;
        $this->setHydrator($hydrator);

        $imageFile = new ImageFile;
        $this->bind($imageFile);
    }

    protected function addElements()
    {
        $this->add([
            'type' => File::class,
            'name' => 'file'
        ]);
    }

    protected function addInputFilter()
    {
        $inputFilter = $this->getInputFilter();

        $imageDir = $this->getImageDir();

        $inputFilter->add([
            'type' => FileInput::class,
            'name'     => 'file',
            'filters'  => [
                [
                    'name' => RenameUpload::class,
                    'options' => [
                        'target'    => $imageDir,
                        'randomize' => true,
                        'use_upload_extension' => true
                    ]
                ]
            ],
            'validators' => [
                [
                    'name' => IsImage::class,
                    'break_chain_on_failure' => true
                ],
                [
                    'name' => ExcludeExtension::class,
                    'options' => [
                        'extension' => ['php'],
                        'case' => true
                    ]
                ]
            ]
        ]);
    }
}