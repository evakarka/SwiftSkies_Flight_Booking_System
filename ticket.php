<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Set font
        $this->SetFont('Arial', 'B', 16);
        // Set fill color
        $this->SetFillColor(50, 50, 100);
        // Add a cell with background color
        $this->Cell(0, 15, 'Airport Ticket', 0, 1, 'C', true);
        // Add an image logo (optional)
        $this->Image('img\SwiftSkies_logo.png', 10, 10, 30);
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Set position 1.5 cm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('Arial', 'I', 8);
        // Set fill color for footer
        $this->SetFillColor(230, 230, 230);
        // Add a cell with background color
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C', true);
        // Add a bottom border
        $this->SetLineWidth(0.5);
        $this->Line(10, 287, 200, 287);
    }

    // Modern styled cell
    function StyledCell($width, $height, $text, $border, $ln, $align, $fill)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(50, 50, 100);
        $this->Cell($width, $height, $text, $border, $ln, $align, $fill);
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Ticket information
$ticket = [
    'Passenger Name' => 'John Doe',
    'Flight Number' => 'AB1234',
    'Departure' => 'New York (JFK)',
    'Arrival' => 'London (LHR)',
    'Date' => '2024-05-20',
    'Departure Time' => '10:00 AM',
    'Arrival Time' => '10:00 PM',
    'Seat' => '12A',
    'Gate' => '22',
    'Class' => 'Economy',
];

// Display ticket information
foreach ($ticket as $key => $value) {
    $pdf->StyledCell(50, 10, $key . ':', 1, 0, 'L', false);
    $pdf->Cell(0, 10, $value, 1, 1);
}

// Output the PDF
$pdf->Output('D', 'airport_ticket.pdf');
?>
