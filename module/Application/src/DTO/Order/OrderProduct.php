<?php
namespace Application\DTO\Order;

use Laminas\Form\Annotation;
use Laminas\Form\Element\Collection;

use Laminas\Form\Annotation\Type;

/**
 * @Annotation\Hydrator("Laminas\Hydrator\ClassMethodsHydrator")
 * @Annotation\Instance("Application\DTO\Order\OrderProduct")
 */
class OrderProduct
{
    /**
     * @Annotation\Required(true)
     * @Annotation\Filter({
     *  "name": "ToInt"
     * })
     * @Annotation\Validator({
     *  "name": "Application\Form\Validator\ExistsValidator",
     *  "options": {"class": "Application\Entity\ProductEntity", "fields": {"id"}}
     * })
     * @Annotation\Name("id")
     */
    protected $id;

    /**
     * @Annotation\Required(true)
     * @Annotation\Filter({
     *  "name": "ToInt"
     * })
     * @Annotation\Name("quantity")
     */
    protected $quantity;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}