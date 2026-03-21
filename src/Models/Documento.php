<?php
namespace App\Models;

use Dompdf\Dompdf;

class Documento {

   public function generarPDF($contenido) {

    if (ob_get_length()) {
        ob_end_clean();
    }

    $dompdf = new \Dompdf\Dompdf();

    $html = "
        <h1>Reporte Generado</h1>
        <p>$contenido</p>
    ";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("reporte.pdf", ["Attachment" => false]);
    exit;
}}