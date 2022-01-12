<?php
namespace Application\Resource\Order;

use Application\Entity\OrderEntity;
use Laminas\Paginator\Paginator;

class OrderResource
{
    public function getCreateResource(OrderEntity $order)
    {
        return [
            'id' => $order->getId()
        ];
    }

    public function getUpdateResource(OrderEntity $order)
    {
        return [
            'id' => $order->getId()
        ];
    }

    public function getListResource(Paginator $paginator)
    {
        $data = [];
        foreach ($paginator as $order) {
            /** @var OrderEntity $order */

            $data['data'][] = [
                'id' => $order->getId(),
                'customer_name' => $order->getCustomer()->getName(),
                'created_at' => $order->getDateCreated()->format('Y-m-d')
            ];
        }

        $data['pages'] = $paginator->getPages();

        return $data;
    }
}