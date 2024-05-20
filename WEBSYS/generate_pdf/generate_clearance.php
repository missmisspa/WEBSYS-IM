<?php
require('./fpdf186/fpdf.php');

$name = 'Mizpa Verstappen Binamira';
$age = 21;
$civil_status = 'Divorced';
$purok = '3'; // Fetched from database

$sex = 'male'; // fetched from database
if ($sex == 'male') {
    $sex = 'he';
} elseif ($sex == 'female') {
    $sex = 'she'; // for he/she in citations
}

$day = '15';
$month = 'March';
$year = '2024';
$purpose = 'Eligible for conducting research works'; // From form or database (alternative)

$imagePath1 = './fpdf186/pics/BRGY LOGO.png';
$imagePath2 = './fpdf186/pics/legazpi-LOGO.png';

class PDF extends FPDF
{
    protected $col = 0; // Current column

    function Header()
    {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'Republic of the Philippines', 0, 1, 'C');
        $this->Ln(-5);
        $this->Cell(0, 10, 'Province of Albay', 0, 1, 'C');
        $this->Ln(-5);
        $this->Cell(0, 10, 'City of Legazpi', 0, 1, 'C');
        $this->Ln(-5);
        $this->Cell(0, 10, 'Barangay 43 - Tamaoyan', 0, 1, 'C');
        $this->Ln(20);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, 'OFFICE OF THE SANGGUNIANG BARANGAY', 0, 1, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 10, 'BARANGAY CLEARANCE', 0, 1, 'C');
        $this->Ln(15);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function SetColumn($col)
    {
        // Set position at a given column
        $this->col = $col;
        $x = 10 + $col * 95;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }

    function AcceptPageBreak()
    {
        if ($this->col < 1) {
            // Go to the next column
            $this->SetColumn($this->col + 1);
            $this->SetY(10);
            return false;
        } else {
            // Go back to the first column and next page
            $this->SetColumn(0);
            return true;
        }
    }

    function ChapterTitle($num, $label)
    {
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(200, 220, 255);
        $this->Cell(0, 6, "Chapter $num : $label", 0, 1, 'L', true);
        $this->Ln(4);
    }

    function ChapterBody($content)
    {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(95, 10, $content);
        $this->Ln();
        $this->SetLeftMargin(10); // Reset to default left margin
        $this->SetX(10); // Reset X position
    }

    function PrintChapter($num, $title, $content)
    {
        $this->AddPage();
        $this->ChapterTitle($num, $title);
        $this->ChapterBody($content);
    }
}

$pdf = new PDF('P', 'mm', 'A4'); // Set page size to A4
$pdf->SetFont('Arial', '', 12);
$pdf->SetMargins(10, 10, 10); // Set the left, top, and right margins

$pdf->AddPage(); // No need to specify orientation, already set to A4

$pdf->Image($imagePath1, 10, 10, 30);
$pdf->Image($imagePath2, $pdf->GetPageWidth() - 10 - 30, 10, 30);
$pdf->Ln(10);

$content = "To WHOM IT MAY CONCERN:";
$content .= "\n\nThis is to certify that $name, $age years old, $civil_status, Filipino Citizen, is a bonafide resident of Purok $purok, Barangay 43, Tamaoyan, Legazpi City.";
$content .= "\nThis is to certify further that $sex is a person known to me of good moral character, and on my own personal knowledge, $sex has not committed in this barangay.";
$content .= "\nIssued this $day day of $month, $year at Tamaoyan, Legazpi City, for whatever legal purpose it may serve.";


$leftcontent = "HON. SYLVIA M. DEL AGUA";
$leftcontent .= "\nPunong Barangay";                     
$leftcontent .= "\nBARANGAY COUNCILORS:";    
$leftcontent .= "\n\t\t\t\t\t\tLolita A. Bremen";                	   
$leftcontent .= "\n\t\t\t\t\t\tNelson B. Baronia";    
$leftcontent .= "\n\t\t\t\t\t\tRey A. Apuli";       
$leftcontent .= "\n\t\t\t\t\t\tFrancia D. Apuli";   
$leftcontent .= "\n\t\t\t\t\t\tJoe B. Andes";   
$leftcontent .= "\n\t\t\t\t\t\tJosefina H. Imperial";              
$leftcontent .= "\n\t\t\t\t\t\tNino D. Manzanillo";  
$leftcontent .= "\nBARANGAY SECRETARY:";    
$leftcontent .= "\n\t\t\t\t\t\tThelma B. Arcinue";   
$leftcontent .= "\nBARANGAY TREASURER:";    
$leftcontent .= "\n\t\t\t\t\t\tRoslyn N. Organo";   
$leftcontent .= "\nSK CHAIRMAN:";     
$leftcontent .= "\n\t\t\t\t\t\tJoseph B. Baronia";       					   

$leftcontent .= "\nAmount Paid: 50.00";
$leftcontent .= "\nIssued on: $month $day, $year";  
$leftcontent .= "\nIssued at: Legazpi City, Albay";
                             

$pdf->SetColumn(0); // Set to the left column
$pdf->SetY(85); // Adjust as necessary to position content properly

$pdf->MultiCell(95, 10, $leftcontent, 0, 'J');

// Set to the right column
$pdf->SetColumn(1);
$pdf->SetY(105); // Adjust as necessary to position content properly

$pdf->MultiCell(95, 10, $content, 0, 'J');

$pdf->Output();
?>
