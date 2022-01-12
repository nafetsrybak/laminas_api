<?php
namespace Application\DTO\Customer;

use Laminas\Form\Annotation;

/**
 * @Annotation\Name("customerList")
 * @Annotation\Hydrator("Laminas\Hydrator\ClassMethodsHydrator")
 * @Annotation\Instance("Application\DTO\Customer\CustomerList")
 */
class CustomerList
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
     * @Annotation\Name("name")
     */
    protected $name;

    /**
     * @Annotation\Required(false)
     * @Annotation\Filter({
     *  "name": "StringTrim",
     *  "name": "StripNewlines",
     *  "name": "StripTags"
     * })
     * @Annotation\Name("surname")
     */
    protected $surname;

    /**
     * @Annotation\Required(false)
     * @Annotation\Validator({
     *  "name": "Date",
     *  "options": {"format": "Y-m-d"}
     * })
     * @Annotation\Name("lastOrderDateFrom")
     */
    protected $lastOrderDateFrom;

    /**
     * @Annotation\Required(false)
     * @Annotation\Validator({
     *  "name": "Date",
     *  "options": {"format": "Y-m-d"}
     * })
     * @Annotation\Name("lastOrderDateTo")
     */
    protected $lastOrderDateTo;

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    public function getLastOrderDateFrom()
    {
        return $this->lastOrderDateFrom;
    }

    public function setLastOrderDateFrom(?string $date): self
    {
        $this->lastOrderDateFrom = $date;
        return $this;
    }

    public function getLastOrderDateTo()
    {
        return $this->lastOrderDateTo;
    }

    public function setLastOrderDateTo(?string $date): self
    {
        $this->lastOrderDateTo = $date;
        return $this;
    }
}