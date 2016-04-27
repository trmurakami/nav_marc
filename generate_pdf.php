<?php

require('inc/fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Cell(60,20,''.$_REQUEST["page"].'');
$pdf->Output();
?>
