<?php
namespace Application\Resource\Upload;

use Application\Entity\FileEntity;

use Application\Service\File\Traits\Path;

class UploadResource
{
    use Path;

    public function getUploadImageFileResource(FileEntity $file)
    {
        return [
            'id' => $file->getId(),
            'path' => $this->getImagePublicPath($file)
        ];
    }
}