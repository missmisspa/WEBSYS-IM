<?php
require('./fpdf186/fpdf.php');
require('../connection.php'); // Include your database connection file

// Create a new PDF instance
$pdf = new FPDF('L'); // Set landscape orientation
$pdf->AddPage();

// Set font for the entire document
$pdf->SetFont('Arial', '', 12);

$pdf->Ln(0);
$pdf->SetFont('Arial', 'B', 14); // Setting font size 14 and bold
$pdf->Cell(0, 10, 'Resident Information', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12); // Resetting font size and weight
$pdf->Ln(5);
    

// Set column widths
$columnWidths = array(30, 30, 30, 30, 30, 40, 45, 30); // Adjust widths as needed

// Fetch data from the database
$sql = "SELECT * FROM resident_info";
$result = mysqli_query($con, $sql);


// Loop through the data and add it to the PDF
while ($row = mysqli_fetch_assoc($result)) {
    for ($i = 0; $i < count($columnWidths); $i++) {
        $pdf->Cell($columnWidths[$i], 10, $row[array_keys($row)[$i]], 1, 0, 'C');
    }
    $pdf->Ln(); // Move to the next line
}

// Output the PDF
$pdf->Output();

// Close the database connection
mysqli_close($con);
?>
