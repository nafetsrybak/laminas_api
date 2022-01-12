<?php
namespace Application\DTO\Product;

use Laminas\Form\Annotation;

/**
 * @Annotation\Name("productList")
 * @Annotation\Hydrator("Laminas\Hydrator\ClassMethodsHydrator")
 * @Annotation\Instance("Application\DTO\Product\ProductList")
 */
class ProductList
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
     * @Annotation\Name("number")
     */
    protected $number;

    /**
     * @Annotation\Required(false)
     * @Annotation\Filter({
     *  "name": "ToInt"
     * })
     * @Annotation\Name("priceFrom")
     */
    protected $priceFrom;

    /**
     * @Annotation\Required(false)
     * @Annotation\Filter({
     *  "name": "ToInt"
     * })
     * @Annotation\Name("priceTo")
     */
    protected $priceTo;

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number)
    {
        $this->number = $number;
    }

    public function getPriceFrom(): ?int
    {
        return $this->priceFrom;
    }

    public function setPriceFrom(?int $priceFrom)
    {
        $this->priceFrom = $priceFrom;
    }

    public function getPriceTo(): ?int
    {
        return $this->priceTo;
    }

    public function setPriceTo(?int $priceTo)
    {
        $this->priceTo = $priceTo;
    }
}