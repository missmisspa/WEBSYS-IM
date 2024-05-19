<?php
require('./fpdf186/fpdf.php');

$name = 'Mizpa Verstappen Binamira';
$age = 21;
$civil_status = 'Divorced';
$purok = '3'; // Fetched from database

$sex = 'male';// fetched from database

if ($sex == 'male')
    $sex = 'he';
elseif ($sex == 'female')
    $sex = 'she'; // for he/she in citations


$day = '15';
$month = 'March';
$year = '2024';
$purpose = 'Eligible for conducting research works'; // From form or database (alternative)

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
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 20  );
$pdf->SetX($leftMargin);
$pdf->Cell($contentWidth, 10, 'BARANGAY CERTIFICATION', 0, 1, 'C');
$pdf->Ln(15);

$pdf->SetFont('Arial', '', 12);
$pdf->SetX($leftMargin);
$pdf->Cell($contentWidth, 5, 'To Whom It May Concern:', 0, 1);
$pdf->Ln(10);

$indent = 10; // di ko ma indent pota

$pdf->SetX($leftMargin);
$pdf->MultiCell($contentWidth, 5, 'This is to certify that ' . $name . ', ' . $age . ' years old, ' . $civil_status . ', Filipino Citizen, is a bonafide resident of Purok ' . $purok . ', Barangay 43, Tamaoyan, Legazpi City.', 0, 'J');
$pdf->Ln(5);

$pdf->SetX($leftMargin);
$pdf->MultiCell($contentWidth, 5, 'This is to certify further that ' .$sex. ' is a/an ' . $purpose . '.', 0, 'J');
$pdf->Ln(5);

$pdf->SetX($leftMargin);
$pdf->MultiCell($contentWidth, 5, 'Issued this ' . $day . ' day of ' . $month . ', ' . $year . ' at Tamaoyan, Legazpi City, for whatever legal purpose it may serve.', 0, 'J');
$pdf->Ln(40);

$pdf->SetX($leftMargin);
$pdf->Cell($emptyCellWidth, 5, '', 0, 0);
$pdf->Cell($cellWidth, 5, 'Hon. Sylvia M. Del Agua', 0, 1, 'R');

$pdf->SetX($leftMargin);
$pdf->Cell($emptyCellWidth, 5, '', 0, 0);
$pdf->Cell($cellWidth, 5, 'Barangay Captain', 0, 1, 'R');

$pdf->Output();
?>