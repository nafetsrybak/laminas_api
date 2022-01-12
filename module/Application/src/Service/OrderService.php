<?php
namespace Application\Service;

use DateTime;
use Laminas\Paginator\Paginator;

use Application\DTO\Order\Order;
use Application\DTO\Order\OrderList;
use Application\Entity\{
    OrderEntity,
    OrderItemEntity
};
use Application\Service\Exception\EntityNotFoundException;
use Application\Repository\{
    CustomerRepository,
    OrderItemRepository,
    OrderRepository,
    ProductRepository
};
use Application\Repository\Adapter\OrderListAdapter;

class OrderService
{
    protected $orderRepository;

    protected $productRepository;

    protected $customerRepository;

    public function __construct(
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository,
        ProductRepository $productRepository,
        CustomerRepository $customerRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->productRepository = $productRepository;
        $this->customerRepository = $customerRepository;
    }

    public function getOrderById($id)
    {
        return $this->orderRepository->find($id);
    }

    public function createOrder(Order $orderDto)
    {
        $dateTime = new DateTime;
        $order = new OrderEntity;

        $order->setDateCreated($dateTime);
        $order->setDateUpdated($dateTime);
        $this->fillOrder($order, $orderDto);
        $this->orderRepository->save($order);

        return $order;
    }

    public function updateOrder(Order $orderDto)
    {
        /** @var OrderEntity|null $customer */
        $order = $this->orderRepository->find($orderDto->getId());
        
        if (!$order) {
            throw EntityNotFoundException::fromClassNameAndIdentifier(ProductEntity::class, $orderDto->getId());
        }

        $dateTime = new DateTime;
        $order->setDateUpdated($dateTime);

        $order->getOrderItems()->clear();

        $this->fillOrder($order, $orderDto);
        $this->orderRepository->save($order);

        return $order;
    }

    public function getOrderList(OrderList $search)
    {
        $adapter = new OrderListAdapter(
            $this->orderRepository,
            $search
        );
        $paginator = new Paginator($adapter);

        if ($search->getPage()) {
            $paginator->setCurrentPageNumber($search->getPage());
        } else {
            $paginator->setCurrentPageNumber(OrderListAdapter::DEFAULT_FISRT_PAGE);
        }
        $paginator->setDefaultItemCountPerPage(OrderListAdapter::DEFAULT_COUNT_PER_PAGE);

        return $paginator;
    }

    protected function fillOrder(OrderEntity $order, Order $orderDto)
    {
        $dateTime = new DateTime;
        $customer = $this->customerRepository->find($orderDto->getCustomerId());

        $order->setCustomer($customer);

        $productIds = [];
        $orderItems = [];
        foreach ($orderDto->getProducts() as $orderProductDto) {
            $productIds[] = $orderProductDto->getId();

            $orderItem = new OrderItemEntity;
            $orderItem->setDateCreated($dateTime);
            $orderItem->setDateUpdated($dateTime);
            $orderItem->setQuantity($orderProductDto->getQuantity());

            $orderItems[$orderProductDto->getId()] = $orderItem;
        }

        $products = $this->productRepository->findBy(['id' => $productIds]);

        foreach ($products as $product) {
            $orderItem = $orderItems[$product->getId()];

            $orderItem->setOrder($order);
            $orderItem->setProduct($product);
            $orderItem->setProductName($product->getName());
            $orderItem->setProductNumber($product->getNumber());
            $orderItem->setProductPrice($product->getPrice());
            
            $order->addOrderItem($orderItem);
        }
    }
}