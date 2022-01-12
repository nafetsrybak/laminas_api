<?php
namespace Application\Controller;

use Laminas\View\Model\JsonModel;
use Laminas\Form\Annotation\AnnotationBuilder;
use Application\Controller\Base\BaseController;

use Application\Form\ImageFileForm;
use Application\Manager\FileManager;
use Application\Resource\Upload\UploadResource;

class UploadController extends BaseController
{
    protected $formBuilder;

    protected $fileManager;

    protected $uploadResource;

    public function __construct(
        AnnotationBuilder $formBuilder,
        FileManager $fileManager,
        UploadResource $uploadResource
    )
    {
        $this->formBuilder = $formBuilder;
        $this->fileManager = $fileManager;
        $this->uploadResource = $uploadResource;
    }

    public function uploadImageAction()
    {
        $response = $this->getResponse();
        $request = $this->getRequest();
        $json = new JsonModel;
        $files = $this->params()->fromFiles();

        $form = new ImageFileForm;
        $form->setData($files);

        if ($form->isValid()) {
            $data = $form->getData();

            $file = $this->fileManager->saveImageFile($data);

            $resource = $this->uploadResource->getUploadImageFileResource($file);
            $response->setStatusCode(200);
            $json->setVariables($resource);
            return $json;
        }

        $response->setStatusCode(422);
        $json->setVariables([
            'messages' => $form->getMessages()
        ]);

        return $json;
    }
}