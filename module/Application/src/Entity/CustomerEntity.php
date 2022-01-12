<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Application\Repository\CustomerRepository;
use Application\Entity\Traits\{
    Identifiable,
    Timestampable
};

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @ORM\Table(name="customer")
 */
class CustomerEntity
{
    use Identifiable, Timestampable;

    /**
     * @ORM\OneToMany(targetEntity="OrderEntity", mappedBy="customer")
     */
    protected $orders;

    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @ORM\Column(name="surname", type="string")
     */
    protected $surname;

    /**
     * @ORM\Column(name="email", type="string", unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="phone", type="string")
     */
    protected $phone;

    /**
     * @ORM\Column(name="discount", type="float")
     */
    protected $discount;

    public function __construct()
    {
        $this->orders = new ArrayCollection;
    }

    /**
     * @return Collection|OrderEntity[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    } 

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }
}