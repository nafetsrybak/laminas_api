<?php
namespace Application\View\Helper;

use Application\Manager\OrderManager;
use Laminas\View\Helper\AbstractHelper;

class OrderManagerHelper extends AbstractHelper
{
    protected $orderManager;

    public function __construct(
        OrderManager $orderManager
    )
    {
        $this->orderManager = $orderManager;
    }

    public function __invoke()
    {
        return $this->orderManager;   
    }
}