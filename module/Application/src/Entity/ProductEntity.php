<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Application\Repository\ProductRepository;
use Application\Entity\Traits\{
    Identifiable,
    Timestampable
};

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\Table(name="product")
 */
class ProductEntity
{
    use Identifiable, Timestampable;

    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @ORM\Column(name="number", type="string")
     */
    protected $number;

    /**
     * @ORM\ManyToOne(targetEntity="FileEntity", inversedBy="products")
     */
    protected $image;

    /**
     * @ORM\Column(name="price", type="integer")
     */
    protected $price;

    /**
     * @ORM\OneToMany(targetEntity="OrderItemEntity", mappedBy="product")
     */
    protected $order_items;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function getImage(): ?FileEntity
    {
        return $this->image;
    }

    public function setImage(?FileEntity $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }
}