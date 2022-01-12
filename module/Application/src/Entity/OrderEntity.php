<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Application\Repository\OrderRepository;
use Application\Entity\Traits\{
    Identifiable,
    Timestampable
};

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class OrderEntity
{
    use Identifiable, Timestampable;

    /**
     * @ORM\ManyToOne(targetEntity="CustomerEntity", inversedBy="orders")
     */
    protected $customer;

    /**
     * @ORM\Column(name="customer_id", type="integer", nullable=true)
     */
    protected $customer_id;

    /**
     * @ORM\OneToMany(targetEntity="OrderItemEntity", mappedBy="order", cascade={"persist"}, orphanRemoval=true)
     */
    protected $order_items;

    public function __construct()
    {
        $this->order_items = new ArrayCollection;
    }

    public function getCustomer(): ?CustomerEntity
    {
        return $this->customer;
    }

    public function setCustomer(CustomerEntity $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return Collection|OrderItemEntity[]
     */
    public function getOrderItems(): Collection
    {
        return $this->order_items;
    }

    public function addOrderItem(OrderItemEntity $order_item): self
    {
        if (!$this->order_items->contains($order_item)) {
            $this->order_items[] = $order_item;
            $order_item->setOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItemEntity $order_item): self
    {
        if ($this->order_items->removeElement($order_item)) {
            if ($order_item->getOrder() === $this) {
                $order_item->setOrder(null);
            }
        }

        return $this;
    }
}