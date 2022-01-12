<?php
namespace Application\Service;

use DateTime;
use Laminas\Paginator\Paginator;

use Application\Repository\{
    ProductRepository,
    FileRepository
};
use Application\DTO\Product\{
    Product,
    ProductList
};
use Application\Entity\ProductEntity;
use Application\Service\Exception\EntityNotFoundException;
use Application\Repository\Adapter\ProductListAdapter;

class ProductService
{
    protected $productRepository;

    protected $fileRepository;

    public function __construct(
        ProductRepository $productRepository,
        FileRepository $fileRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->fileRepository = $fileRepository;
    }

    public function createProduct(Product $productDto): ProductEntity
    {
        $dateTime = new DateTime;
        $product = new ProductEntity;

        $product->setDateCreated($dateTime);
        $product->setDateUpdated($dateTime);
        $this->fillProduct($product, $productDto);
        $this->productRepository->save($product);

        return $product;
    }

    public function updateProduct(Product $productDto): ProductEntity
    {
        /** @var ProductEntity|null $customer */
        $product = $this->productRepository->find($productDto->getId());
        
        if (!$product) {
            throw EntityNotFoundException::fromClassNameAndIdentifier(ProductEntity::class, $productDto->getId());
        }

        $dateTime = new DateTime;

        $product->setDateUpdated($dateTime);
        $this->fillProduct($product, $productDto);
        $this->productRepository->save($product);

        return $product;
    }

    public function getProductList(ProductList $search)
    {
        $adapter = new ProductListAdapter(
            $this->productRepository,
            $search
        );
        $paginator = new Paginator($adapter);

        if ($search->getPage()) {
            $paginator->setCurrentPageNumber($search->getPage());
        } else {
            $paginator->setCurrentPageNumber(ProductListAdapter::DEFAULT_FISRT_PAGE);
        }
        $paginator->setDefaultItemCountPerPage(ProductListAdapter::DEFAULT_COUNT_PER_PAGE);

        return $paginator;
    }

    public function deleteProductById(int $id)
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            return;
        }

        $this->productRepository->delete($product);
    }

    protected function fillProduct(ProductEntity $productEntity, Product $product)
    {
        $productEntity
            ->setName($product->getName())
            ->setNumber($product->getNumber())
            ->setPrice($product->getPrice())
        ;

        $image_id = $product->getImageId();

        if (isset($image_id)) {
            $file = $this->fileRepository->findOneById($product->getImageId());

            $productEntity->setImage($file);
        }
    }
}