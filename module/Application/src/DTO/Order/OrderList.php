<?php
namespace Application\DTO\Order;

use Laminas\Form\Annotation;

/**
 * @Annotation\Name("orderList")
 * @Annotation\Hydrator("Laminas\Hydrator\ClassMethodsHydrator")
 * @Annotation\Instance("Application\DTO\Order\OrderList")
 */
class OrderList
{
    /**
     * @Annotation\Required(false)
     * @Annotation\Filter({
     *  "name": "ToInt"
     * })
     * @Annotation\Name("page")
     */
    protected $page;

    /**
     * @Annotation\Required(false)
     * @Annotation\Filter({
     *  "name": "StringTrim",
     *  "name": "StripNewlines",
     *  "name": "StripTags"
     * })
     * @Annotation\Name("customer_name")
     */
    protected $customer_name;

    /**
     * @Annotation\Required(false)
     * @Annotation\Validator({
     *  "name": "Date",
     *  "options": {"format": "Y-m-d"}
     * })
     * @Annotation\Name("createdAtFrom")
     */
    protected $createdAtFrom;

    /**
     * @Annotation\Required(false)
     * @Annotation\Validator({
     *  "name": "Date",
     *  "options": {"format": "Y-m-d"}
     * })
     * @Annotation\Name("createdAtTo")
     */
    protected $createdAtTo;

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function getCustomerName(): ?string
    {
        return $this->customer_name;
    }

    public function setCustomerName(?string $customer_name): self
    {
        $this->customer_name = $customer_name;
        return $this;
    }

    public function getCreatedAtFrom(): ?string
    {
        return $this->createdAtFrom;
    }

    public function setCreatedAtFrom(?string $date): self
    {
        $this->createdAtFrom = $date;
        return $this;
    }

    public function getCreatedAtTo(): ?string
    {
        return $this->createdAtTo;
    }

    public function setCreatedAtTo(?string $date): self
    {
        $this->createdAtTo = $date;
        return $this;
    }
}