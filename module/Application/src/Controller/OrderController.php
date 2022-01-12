<?php
namespace Application\Controller;

use Laminas\View\Model\JsonModel;
use Laminas\Form\Annotation\AnnotationBuilder;
use Application\Controller\Base\BaseRestfulController;

use Application\DTO\Order\{
    Order,
    OrderList,
    UpdateOrder
};
use Application\Manager\OrderManager;
use Application\Resource\Order\OrderResource;

class OrderController extends BaseRestfulController
{
    protected $orderManager;

    protected $orderResource;

    protected $formBuilder;

    public function __construct(
        OrderManager $orderManager,
        OrderResource $orderResource,
        AnnotationBuilder $formBuilder
    )
    {
        $this->orderManager = $orderManager;
        $this->orderResource = $orderResource;
        $this->formBuilder = $formBuilder;
    }

    public function getList()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $data = $request->getQuery();
        $json = new JsonModel;

        $form = $this->formBuilder->createForm(OrderList::class);
        $form->setData($data);
        if ($form->isValid()) {
            $data = $form->getData();

            $orderList = $this->orderManager->getOrderList($data);

            $resource = $this->orderResource->getListResource($orderList);
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
     * Create a new resource
     *
     * @param  mixed $data
     * @return JsonModel
     */
    public function create($data)
    {
        $response = $this->getResponse();
        $json = new JsonModel;

        $form = $this->formBuilder->createForm(Order::class);
        if (!empty($data)) {
            $form->setData($data);
        }

        if ($form->isValid()) {
            /** @var Order $data */
            $data = $form->getData();

            $order = $this->orderManager->createOrder($data);

            $resource = $this->orderResource->getCreateResource($order);
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

    public function update($id, $data)
    {
        $response = $this->getResponse();
        $json = new JsonModel;

        $form = $this->formBuilder->createForm(UpdateOrder::class);
        if (!empty($data)) {
            $form->setData($data);
        }

        if ($form->isValid()) {
            /** @var Order $data */
            $data = $form->getData();

            $order = $this->orderManager->updateOrder($data);

            $resource = $this->orderResource->getUpdateResource($order);
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
}