<?php
namespace Application\DTO\Order;

use Laminas\Form\Annotation;

/**
 * @Annotation\Name("order")
 * @Annotation\Hydrator("Laminas\Hydrator\ClassMethodsHydrator")
 * @Annotation\Instance("Application\DTO\Order\Order")
 * @Annotation\ValidationGroup({
 *  "id",
 *  "customer_id",
 *  "products": {
 *      "id", "quantity"
 *  }
 * })
 */
class UpdateOrder extends Order
{
    /**
     * @Annotation\Filter({
     *  "name": "ToInt"
     * })
     * @Annotation\Validator({
     *  "name": "Application\Form\Validator\ExistsValidator",
     *  "options": {"class": "Application\Entity\OrderEntity", "fields": {"id"}}
     * })
     * @Annotation\Name("id")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}