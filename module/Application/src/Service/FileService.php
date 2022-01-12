<?php
namespace Application\Service;

use DateTime;

use Application\DTO\Image\ImageFile;
use Application\Entity\FileEntity;
use Application\Repository\FileRepository;

class FileService
{
    protected $fileRepository;

    public function __construct(
        FileRepository $fileRepository
    )
    {
        $this->fileRepository = $fileRepository;  
    }

    public function createFile(ImageFile $fileDto)
    {
        $dateTime = new DateTime;
        $file = new FileEntity;

        $file->setDateCreated($dateTime);
        $file->setDateUpdated($dateTime);
        $this->fillFile($file, $fileDto);
        $this->fileRepository->save($file);

        return $file;
    }

    protected function fillFile(FileEntity $file, ImageFile $fileDto)
    {
        $uploadedFile = $fileDto->getFile();
        $file
            ->setName($uploadedFile['name'])
            ->setType($uploadedFile['type'])
            ->setPath($uploadedFile['tmp_name'])
        ;
    }
}