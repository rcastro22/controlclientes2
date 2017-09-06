<?php
require('fpdf16/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',40);
$pdf->Cell(40,10,'Hola, Mundo');
$pdf->Output();
?>

