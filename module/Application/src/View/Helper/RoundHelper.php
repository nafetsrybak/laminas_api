<?php
namespace Application\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class RoundHelper extends AbstractHelper
{
    public function __invoke($number)
    {
        $number = (float) $number;
        return round($number, 2);   
    }
}