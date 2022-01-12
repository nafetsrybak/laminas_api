<?php
namespace Application\Resource\Customer;

use DateTime;
use Application\Entity\CustomerEntity;
use Laminas\Paginator\Paginator;

class CustomerResource
{
    public function getCreateResource(CustomerEntity $customer)
    {
        return [
            'id' => $customer->getId()
        ];
    }

    public function getListResource(Paginator $paginator)
    {
        $data = [];
        foreach ($paginator as $item) {
            /** @var CustomerEntity $customer */
            $customer = $item['customer'];

            $lastOrderDate = null;
            if ($item['lastOrderDate']) {
                $lastOrderDate = (new DateTime($item['lastOrderDate']))->format('Y-m-d');
            }

            $data['data'][] = [
                'id' => $customer->getId(),
                'name' => $customer->getName(),
                'surname' => $customer->getSurname(),
                'email' => $customer->getEmail(),
                'lastOrderDate' => $lastOrderDate
            ];
        }

        $data['pages'] = $paginator->getPages();

        return $data;
    }
}