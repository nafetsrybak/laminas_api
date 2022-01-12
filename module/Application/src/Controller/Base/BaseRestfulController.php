<?php

namespace Application\Controller\Base;

use Laminas\Mvc\Controller\AbstractRestfulController;

/**
 * @method \Laminas\Http\PhpEnvironment\Response|\Laminas\Stdlib\ResponseInterface getResponse()
 * @method \Laminas\Http\PhpEnvironment\Request|\Laminas\Stdlib\RequestInterface getRequest()
 */
abstract class BaseRestfulController extends AbstractRestfulController
{
}