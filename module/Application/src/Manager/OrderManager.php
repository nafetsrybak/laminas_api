<?php
namespace Application\Manager;

use Application\DTO\Order\Order;
use Application\DTO\Order\OrderList;
use Application\Entity\{
    OrderEntity,
    OrderItemEntity,
    ProductEntity
};
use Application\Service\OrderService;

class OrderManager
{
    protected $orderService;

    /**
     * @var int
     */
    protected $totalOrderPrice;

    /**
     * @var int
     */
    protected $subTotalOrderPrice;

    /**
     * @var int
     */
    protected $discountSum;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function getOrderById($id)
    {
        $order = $this->orderService->getOrderById($id);

        return $order;
    }

    public function getTotalOrderPrice(OrderEntity $order)
    {
        if ($this->totalOrderPrice) {
            return $this->totalOrderPrice;
        }

        $subTotalOrderPrice = $this->getSubTotalOrderPrice($order);
        $discountSum = $this->getOrderDiscountSum($order);

        $totalOrderPrice = $subTotalOrderPrice - $discountSum;

        return $this->totalOrderPrice = $totalOrderPrice;
    }

    public function getSubTotalOrderPrice(OrderEntity $order)
    {
        if (isset($this->subTotalOrderPrice)) {
            return $this->subTotalOrderPrice;
        }

        $subTotalOrderPrice = 0;
        foreach ($order->getOrderItems() as $orderItem) {
            $itemPrice = $orderItem->getProductPrice() * $orderItem->getQuantity();

            $subTotalOrderPrice += $itemPrice;
        }
        $subTotalOrderPrice /= 100;

        return $this->subTotalOrderPrice = $subTotalOrderPrice;
    }

    public function getOrderDiscountSum(OrderEntity $order)
    {
        if (isset($this->discountSum)) {
            return $this->discountSum;
        }

        $discountSum = 0;
        $subTotalOrderPrice = $this->getSubTotalOrderPrice($order);

        $customer = $order->getCustomer();

        $discountSum = $subTotalOrderPrice * $customer->getDiscount();
        $discountSum /= 100;

        return $this->discountSum = $discountSum;
    }

    public function getProductPrice(ProductEntity $productEntity)
    {
        return $productEntity->getPrice() / 100;
    }

    public function getOrderItemPrice(OrderItemEntity $productEntity)
    {
        return $productEntity->getProductPrice() / 100;
    }

    public function getOrderList(OrderList $search)
    {
        $orderList = $this->orderService->getOrderList($search);

        return $orderList;
    }

    public function createOrder(Order $orderDto)
    {
        $order = $this->orderService->createOrder($orderDto);

        return $order;
    }

    public function updateOrder(Order $orderDto)
    {
        $order = $this->orderService->updateOrder($orderDto);

        return $order;
    }
}