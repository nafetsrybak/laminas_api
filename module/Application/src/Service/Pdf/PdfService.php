<?php
namespace Application\Service\Pdf;

use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class PdfService
{
    public function generateFromHtml(string $html)
    {
        $mpdf = new Mpdf();
    
        $mpdf->WriteHTML($html);
        return $mpdf->Output('', Destination::STRING_RETURN);
    }
}