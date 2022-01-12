<?php
namespace Application\Resource\Product;

use Laminas\Paginator\Paginator;

use Application\Entity\ProductEntity;
use Application\Service\File\Traits\Path;

class ProductResource
{
    use Path;

    public function getCreateResource(ProductEntity $product)
    {
        return [
            'id' => $product->getId()
        ];
    }

    public function getUpdateResource(ProductEntity $product)
    {
        return [
            'id' => $product->getId()
        ];
    }

    public function getListResource(Paginator $paginator)
    {
        $data = [];
        foreach ($paginator as $product) {
            /** @var ProductEntity $product */

            $productImage = $product->getImage();

            $imageUrl = null;
            if ($productImage) {
                $imageUrl = $this->getImagePublicPath($productImage);
            }

            $data['data'][] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'number' => $product->getNumber(),
                'price' => $product->getPrice(),
                'imageUrl' => $imageUrl
            ];
        }

        $data['pages'] = $paginator->getPages();

        return $data;
    }
}