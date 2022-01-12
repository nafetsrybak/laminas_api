<?php
namespace Application\Resource\Pdf;

use Laminas\View\Model\ViewModel;
use Laminas\Http\PhpEnvironment\Response;
use Laminas\View\Renderer\PhpRenderer;

use Application\Entity\OrderEntity;
use Application\Service\Pdf\PdfService;

class PdfResource
{
    protected $viewRenderer;

    protected $pdfService;

    public function __construct(
        PhpRenderer $viewRenderer,
        PdfService $pdfService
    )
    {
       $this->viewRenderer = $viewRenderer;
       $this->pdfService = $pdfService;
    }

    public function getOrderPdfResource(OrderEntity $order, Response $response)
    {
        $viewModel = new ViewModel([
            'order' => $order
        ]);
        $viewModel->setTemplate('application/pdf/order_pdf');

        $html = $this->viewRenderer->render($viewModel);
        // echo $html;
        // die;
        $pdf = $this->pdfService->generateFromHtml($html);

        $headers = $response->getHeaders();
        $headers->addHeaderLine(
            'Content-Type: application/pdf'
        );

        $response->setContent($pdf);

        return $response;
    }
}