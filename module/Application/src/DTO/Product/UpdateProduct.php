<?php
namespace Application\DTO\Product;

use Laminas\Form\Annotation;

/**
 * @Annotation\Name("product")
 * @Annotation\Hydrator("Laminas\Hydrator\ClassMethodsHydrator")
 * @Annotation\Instance("Application\DTO\Product\Product")
 */
class UpdateProduct
{
    /**
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
     * @Annotation\Filter({
     *  "name": "StringTrim",
     *  "name": "StripNewlines",
     *  "name": "StripTags"
     * })
     * @Annotation\Name("name")
     */
    protected $name;

    /**
     * @Annotation\Filter({
     *  "name": "StringTrim",
     *  "name": "StripNewlines",
     *  "name": "StripTags"
     * })
     * @Annotation\Name("number")
     */
    protected $number;

    /**
     * @Annotation\Filter({
     *  "name": "ToInt"
     * })
     * @Annotation\Validator({
     *  "name": "GreaterThan",
     *  "options": {"min": "0", "inclusive": true}
     * })
     * @Annotation\Name("price")
     */
    protected $price;

    /**
     * @Annotation\Required(false)
     * @Annotation\Filter({
     *  "name": "ToInt"
     * })
     * @Annotation\Validator({
     *  "name": "Application\Form\Validator\ExistsValidator",
     *  "options": {"class": "Application\Entity\FileEntity", "fields": {"id"}}
     * })
     * @Annotation\Name("image_id")
     */
    protected $image_id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getImageId()
    {
        return $this->image_id;
    }

    public function setImageId($image_id)
    {
        $this->image_id = $image_id;
    }
}