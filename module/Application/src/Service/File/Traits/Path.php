<?php
namespace Application\Service\File\Traits;

use Application\Entity\FileEntity;
use Exception;
use DateTime;

trait Path
{
    public function getImagePublicPath(FileEntity $file)
    {
        return substr($file->getPath(), 8);
    }

    public function getImageDir()
    {
        $path = './public/img/' . (new DateTime)->format('Y_m_d') . '/';

        $this->createDirectoryIfNotExists($path);

        return $path;
    }

    protected function createDirectoryIfNotExists(string $path)
    {
        if (!is_dir($path)) {
            if (!mkdir($path, 0774, true)) {
                throw new Exception('Cant create path: ' . $path);
            }
        }
  
        return $path;
    }
}