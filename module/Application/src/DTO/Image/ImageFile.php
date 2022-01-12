<?php
namespace Application\DTO\Image;

class ImageFile
{
    protected $file;

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }
}