<?php
namespace Application\Controller;

use Application\Controller\Base\BaseController;
use Application\Manager\OrderManager;
use Application\Resource\Pdf\PdfResource;

class PdfController extends BaseController
{
    protected $orderManager;

    protected $pdfResource;

    public function __construct(
        OrderManager $orderManager,
        PdfResource $pdfResource
    )
    {
        $this->orderManager = $orderManager;
        $this->pdfResource = $pdfResource;
    }

    public function getOrderPdfAction()
    {
        $id = $this->params()->fromRoute('id', null);

        $order = $this->orderManager->getOrderById($id);

        if (!$order) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $response = $this->getResponse();

        return $this->pdfResource->getOrderPdfResource($order, $response);
    }
}