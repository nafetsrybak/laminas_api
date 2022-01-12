<?php
namespace Application\Manager;

use Application\Service\FileService;
use Application\DTO\Image\ImageFile;

class FileManager
{
    protected $fileService;

    public function __construct(
        FileService $fileService
    )
    {
        $this->fileService = $fileService;
    }

    public function saveImageFile(ImageFile $data)
    {
        $file = $this->fileService->createFile($data);

        return $file;
    }
}