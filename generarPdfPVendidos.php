<?php
require('./pdf/fpdf.php');

require_once "./db/database.php";
header('Content-Type: text/html; charset=utf-8'); 

$productosMasVendidos = productos_mas_vendidos();



 $pdf = new FPDF();
 
$pdf->AddPage();
// Add a Unicode font (uses UTF-8)
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(25,133,191);
$pdf->SetDrawColor(183,229,250);
$pdf->SetTextColor(255,255,255);

$pdf->Cell(190,10, iconv('utf-8', 'ISO-8859-2', "Unidades más VENDIDAS"),1, 1, 'C', 1);


$pdf->Cell(95,10, iconv('utf-8', 'ISO-8859-2', "U"),1, 0, 'C', 1);
$pdf->Cell(95,10, iconv('utf-8', 'ISO-8859-2', "Nombre"),1, 1, 'C', 1);
$pdf->SetTextColor(0,0,0);

foreach($productosMasVendidos as $key => $value) {
    $pdf->Cell(95,10, iconv('utf-8', 'ISO-8859-2', $value["count(*)"]),1, 0, 'C', 0);
    $pdf->Cell(95,10, iconv('utf-8', 'ISO-8859-2', " [-] " .  $value["nombre"]),1, 0, 'L', 0);

    $pdf->Ln(10);
 }


 $pdf->Output();

?>