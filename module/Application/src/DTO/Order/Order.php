<?php
namespace Application\DTO\Order;

use Laminas\Form\Annotation;

/**
 * @Annotation\Name("order")
 * @Annotation\Hydrator("Laminas\Hydrator\ClassMethodsHydrator")
 * @Annotation\Instance("Application\DTO\Order\Order")
 * @Annotation\ValidationGroup({
 *  "customer_id",
 *  "products": {
 *      "id", "quantity"
 *  }
 * })
 */
class Order
{
    protected $id;

    /**
     * @Annotation\Filter({
     *  "name": "ToInt"
     * })
     * @Annotation\Validator({
     *  "name": "Application\Form\Validator\ExistsValidator",
     *  "options": {"class": "Application\Entity\CustomerEntity", "fields": {"id"}}
     * })
     * @Annotation\Name("customer_id")
     */
    protected $customer_id;

    /**
     * @Annotation\Required(true)
     * @Annotation\ComposedObject({
     *  "target_object": "Application\DTO\Order\OrderProduct",
     *  "is_collection": true,
     *  "options": {}
     * })
     * @Annotation\Input("Application\Form\InputFilter\CollectionInputFilter")
     * @Annotation\Name("products")
     */
    protected $products;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setProducts($products)
    {
        $this->products = $products;
    }
}