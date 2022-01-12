<?php
namespace Application\Controller;

use Laminas\View\Model\JsonModel;
use Laminas\Form\Annotation\AnnotationBuilder;
use Application\Controller\Base\BaseRestfulController;

use Application\DTO\Product\{
    Product,
    ProductList,
    UpdateProduct
};
use Application\Manager\ProductManager;
use Application\Resource\Product\ProductResource;

class ProductController extends BaseRestfulController
{
    protected $productManager;

    protected $formBuilder;

    protected $productResource;

    public function __construct(
        ProductManager $productManager,
        ProductResource $productResource,
        AnnotationBuilder $formBuilder
    )
    {
        $this->productManager = $productManager;
        $this->productResource = $productResource;
        $this->formBuilder = $formBuilder;
    }

    /**
     * Create a new resource
     *
     * @param  mixed $data
     * @return JsonModel
     */
    public function create($data)
    {
        $response = $this->getResponse();
        $json = new JsonModel;

        $form = $this->formBuilder->createForm(Product::class);
        if (!empty($data)) {
            $form->setData($data);
        }

        if ($form->isValid()) {
            /** @var Product $data */
            $data = $form->getData();

            $product = $this->productManager->createProduct($data);

            $resource = $this->productResource->getCreateResource($product);
            $response->setStatusCode(200);
            $json->setVariables($resource);
            return $json;
        }

        $response->setStatusCode(422);
        $json->setVariables([
            'messages' => $form->getMessages()
        ]);

        return $json;
    }

    public function patch($id, $data)
    {
        $response = $this->getResponse();
        $json = new JsonModel;

        $form = $this->formBuilder->createForm(UpdateProduct::class);
        if (!empty($data)) {
            $form->setData($data);
        }

        if ($form->isValid()) {
            /** @var Product $data */
            $data = $form->getData();

            $product = $this->productManager->updateProduct($data);

            $resource = $this->productResource->getUpdateResource($product);
            $response->setStatusCode(200);
            $json->setVariables($resource);
            return $json;
        }

        $response->setStatusCode(422);
        $json->setVariables([
            'messages' => $form->getMessages()
        ]);

        return $json;
    }

    /**
     * Return list of resources
     *
     * @return JsonModel
     */
    public function getList()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $data = $request->getQuery();
        $json = new JsonModel;

        $form = $this->formBuilder->createForm(ProductList::class);
        $form->setData($data);
        if ($form->isValid()) {
            $data = $form->getData();

            $productList = $this->productManager->getProductList($data);

            $resource = $this->productResource->getListResource($productList);
            $response->setStatusCode(200);
            $json->setVariables($resource);
            return $json;
        }

        $response->setStatusCode(422);
        $json->setVariables([
            'messages' => $form->getMessages()
        ]);

        return $json;
    }

    public function delete($id)
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $data = $this->processBodyContent($request);

        if (!isset($data['id'])) {
            $response->setStatusCode(404);        
            return $response;
        }

        $this->productManager->deleteProductById((int) $data['id']);

        $response->setStatusCode(200);        
        return $response;
    }
}