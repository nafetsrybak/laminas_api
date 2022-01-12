<?php
namespace Application\Manager;

use Application\Service\ProductService;
use Application\DTO\Product\{
    Product,
    ProductList
};
use Application\Entity\ProductEntity;

class ProductManager
{
    protected $productService;

    public function __construct(
        ProductService $productService
    )
    {
        $this->productService = $productService;
    }

    public function createProduct(Product $productDto): ProductEntity
    {
        $product = $this->productService->createProduct($productDto);

        return $product;
    }

    public function updateProduct(Product $productDto): ProductEntity
    {
        $product = $this->productService->updateProduct($productDto);

        return $product;
    }

    public function getProductList(ProductList $search)
    {
        $productList = $this->productService->getProductList($search);

        return $productList;
    }

    public function deleteProductById(int $id)
    {
        $this->productService->deleteProductById($id);
    }
}