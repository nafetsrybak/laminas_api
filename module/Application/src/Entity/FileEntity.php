<?php
namespace Application\Entity;

use Laminas\Form\Annotation;
use Doctrine\ORM\Mapping as ORM;

use Application\Repository\FileRepository;
use Application\Entity\Traits\{
    Identifiable,
    Timestampable
};

/**
 * @Annotation\Hydrator("Laminas\Hydrator\ClassMethodsHydrator")
 * 
 * @ORM\Entity(repositoryClass=FileRepository::class)
 * @ORM\Table(name="file")
 */
class FileEntity
{
    use Identifiable, Timestampable;

    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @ORM\Column(name="type", type="string")
     */
    protected $type;

    /**
     * @ORM\Column(name="path", type="string")
     */
    protected $path;

    /**
     * @ORM\OneToMany(targetEntity="ProductEntity", mappedBy="image")
     */
    protected $products;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }
}