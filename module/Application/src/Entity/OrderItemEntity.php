<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Application\Repository\OrderItemRepository;
use Application\Entity\Traits\{
    Identifiable,
    Timestampable
};

/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 * @ORM\Table(name="`order_item`")
 */
class OrderItemEntity
{
    use Identifiable, Timestampable;

    /**
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="OrderEntity", inversedBy="order_items")
     */
    protected $order;

    /**
     * @ORM\Column(name="product_name", type="string")
     */
    protected $product_name;

    /**
     * @ORM\Column(name="product_price", type="integer")
     */
    protected $product_price;

    /**
     * @ORM\Column(name="product_number", type="string")
     */
    protected $product_number;

    /**
     * @ORM\ManyToOne(targetEntity="ProductEntity", inversedBy="order_items")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $product;

    public function getOrder(): ?OrderEntity
    {
        return $this->order;
    }

    public function setOrder(?OrderEntity $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function getProduct(): ?ProductEntity
    {
        return $this->product;
    }

    public function setProduct(?ProductEntity $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getProductPrice(): ?int
    {
        return $this->product_price;
    }

    public function setProductPrice(int $price): self
    {
        $this->product_price = $price;
        return $this;
    }

    public function getProductNumber(): ?string
    {
        return $this->product_number;
    }

    public function setProductNumber(string $number): self
    {
        $this->product_number = $number;
        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $name): self
    {
        $this->product_name = $name;
        return $this;
    }
}