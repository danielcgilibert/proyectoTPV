<?php
require('./pdf/fpdf.php');

require_once "./db/database.php";
header('Content-Type: text/html; charset=utf-8'); 
$idTicket = $_REQUEST["idTicket"];
$nombreUsuario = $_REQUEST["nombreUsuario"];
$apellidoUsuario = $_REQUEST["apellidoUsuario"];
$idMesa = $_REQUEST["idMesa"];
$fecha = $_REQUEST["fecha"];

$lineas = cargar_lineas_Ticket($idTicket);

$total = 0;
// echo "<pre>";
// print_r($lineas);
// echo "</pre>";


 $pdf = new FPDF();
 
 $pdf->AddPage();
// Add a Unicode font (uses UTF-8)
$pdf->SetFont('Arial','B',8);

// Load a UTF-8 string from a file and print it
$pdf->SetFillColor(25,133,191);
$pdf->SetDrawColor(183,229,250);
$pdf->SetTextColor(255,255,255);

$pdf->Cell(190,10, iconv('utf-8', 'ISO-8859-2', "Ticket ID " . "|  " . $idTicket . "  |  $fecha"),1, 0, 'C', 1);
$pdf->SetTextColor(255,255,255);
$pdf->SetTextColor(0,0,0);

$pdf->Ln(15);



$pdf->SetTextColor(255,255,255);

$pdf->Cell(60,10, iconv('utf-8', 'ISO-8859-2', "Atendido Por "),1, 0, 'C', 1);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(130,10, iconv('utf-8', 'ISO-8859-2', $nombreUsuario . " " .$apellidoUsuario),1, 1, 'C', 0);
$pdf->SetTextColor(255,255,255);

$pdf->Ln(2);

$pdf->Cell(60,10, iconv('utf-8', 'ISO-8859-2', "En la Mesa"),1, 0, 'C', 1);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(130,10, iconv('utf-8', 'ISO-8859-2', $idMesa),1, 1, 'C', 0);
$pdf->SetTextColor(255,255,255);


$pdf->Ln(2);


$pdf->Cell(60,10, iconv('utf-8', 'ISO-8859-2', "Empresa "),0, 0, 'C', 1);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(30,10, iconv('utf-8', 'ISO-8859-2', "03423826T"),1, 0, 'C', 0);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(60,10, iconv('utf-8', 'ISO-8859-2', "Aroma tapas EP"),1, 0, 'C', 0);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(40,10, iconv('utf-8', 'ISO-8859-2',"678335923"),1, 1, 'C', 0);
$pdf->SetTextColor(255,255,255);


$pdf->Ln(2);


$pdf->Cell(10,10, iconv('utf-8', 'ISO-8859-2', "U"),0, 0, 'C', 1);
$pdf->Cell(60,10, iconv('utf-8', 'ISO-8859-2', "Nombre"),1, 0, 'C', 1);
$pdf->Cell(60,10, iconv('utf-8', 'ISO-8859-2', "Precio"),1, 0, 'C', 1);
$pdf->Cell(60,10, iconv('utf-8', 'ISO-8859-2', "Importe"),1, 1, 'C', 1);
$pdf->SetTextColor(0,0,0);

foreach($lineas as $key => $value) {
    $importe = (float)$value["unidadesPedidas"] * (float)$value["precio"];
    $pdf->Cell(10,10, iconv('utf-8', 'ISO-8859-2', $value["unidadesPedidas"]),1, 0, 'C', 0);

    $pdf->Cell(60,10, iconv('utf-8', 'ISO-8859-2', " [-] " .  $value["nombre"]),1, 0, 'L', 0);
    $pdf->Cell(60,10, $value["precio"] ,1, 0, 'C', 0);
    $pdf->Cell(60,10, $importe,1, 0, 'C', 0);

    $pdf->Ln(10);
    $total = $total + $importe;
 }



 $pdf->SetTextColor(255,255,255);

 $pdf->Cell(190,10, iconv('utf-8', 'ISO-8859-2',"Total : " . $total),1, 0, 'C', 1);

 $pdf->Output();

    ?>