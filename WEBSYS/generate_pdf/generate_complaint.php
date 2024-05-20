<?php
require('./fpdf186/fpdf.php');


$case_no = '1'; // Fetched from database, count rows of complaint table
$complainant = 'Mizpa Verstappen Binamira';
$respondent = 'Cedrick Ballon';

//schedule of hearing
$day1 = '17';
$month1 = 'March';
$year1 = '2024';
$hour = '8:00 am'; // From form

//issued date
$day = '15';
$month = 'March';
$year = '2024'; // From form

$imagePath1 = './fpdf186/pics/BRGY LOGO.png';
$imagePath2 = './fpdf186/pics/legazpi-LOGO.png';

$pdf = new FPDF();
$pdf->AddPage();

$leftMargin = 20;
$rightMargin = 20;
$pdf->SetMargins($leftMargin, 10, $rightMargin); // Set the left, top, and right margins

$cellWidth = 60; // Width of the right-aligned cell
$contentWidth = $pdf->GetPageWidth() - $leftMargin - $rightMargin;
$emptyCellWidth = $contentWidth - $cellWidth;

$pdf->SetAutoPageBreak(true, 10); // Set auto page break

$pdf->Image($imagePath1, $leftMargin, 15, 30);
$pdf->Image($imagePath2, $pdf->GetPageWidth() - $rightMargin - 30, 15, 30);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX($leftMargin);
$pdf->Cell($contentWidth, 10, 'Republic of the Philippines', 0, 1, 'C');
$pdf->Ln(-5);
$pdf->SetX($leftMargin);
$pdf->Cell($contentWidth, 10, 'Province of Albay', 0, 1, 'C');
$pdf->Ln(-5);
$pdf->SetX($leftMargin);
$pdf->Cell($contentWidth, 10, 'City of Legazpi', 0, 1, 'C');
$pdf->Ln(-5);
$pdf->SetX($leftMargin);
$pdf->Cell($contentWidth, 10, 'Barangay 43 - Tamaoyan', 0, 1, 'C');
$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetX($leftMargin);
$pdf->Cell($contentWidth, 10, 'OFFICE OF THE SANGGUNIANG BARANGAY', 0, 1, 'C');
$pdf->Ln(20);

$pdf->SetFont('Arial', '', 12);
$pdf->SetX($leftMargin);
$pdf->Cell($contentWidth, 5, 'Brgy. Case No:'.$case_no.'',0, 1,'R');
$pdf->Cell($contentWidth, 5, 'For: 1st  hearing', 0, 1,'R');
$pdf->Ln(10);

$indent = 10; // di ko ma indent pota

$pdf->SetFont('Arial', '', 12);
$pdf->SetX($leftMargin);
$pdf->Cell($contentWidth, 5,'' .$respondent. '',0, 1,'L');
$pdf->Cell($contentWidth, 5, 'Respondent', 0, 1,'L');
$pdf->Ln(10);

$pdf->SetX($leftMargin);
$pdf->MultiCell($contentWidth, 5,'You are hereby notified to appear before me on the'.$day1.'day of '.$month1.','.$year1.', at ' .$hour. ' at Tamaoyan Barangay Hall for a hearing of  the  complaint of Mr/Mrs '.$respondent.'.', 0, 'J');
$pdf->Ln(20);

$pdf->SetX($leftMargin);
$pdf->MultiCell($contentWidth, 5, 'Notified this ' . $day . ' day of ' . $month . ', ' . $year . '.', 0, 'J');
$pdf->Ln(40);

$pdf->SetX($leftMargin);
$pdf->Cell($emptyCellWidth, 5, '', 0, 0);
$pdf->Cell($cellWidth, 5, 'Hon. Sylvia M. Del Agua', 0, 1, 'R');

$pdf->SetX($leftMargin);
$pdf->Cell($emptyCellWidth, 5, '', 0, 0);
$pdf->Cell($cellWidth, 5, 'Barangay Captain', 0, 1, 'R');

$pdf->Output();
?>
