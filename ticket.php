<?php
require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->SetFillColor(0, 33, 68); 
        $this->SetTextColor(255, 255, 255); 

        $this->Cell(0, 20, 'SwiftSkies Airlines', 0, 1, 'C', true);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Border Pass', 0, 1, 'C', true);


        $this->Image('img/SwiftSkies_logo.png', 10, 20, 30); 

        $this->Ln(20);
    }


    function Footer()
    {

        $this->SetY(-10);

        $this->SetFont('Arial', 'I', 8);

        $this->SetFillColor(230, 230, 230); 

        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C', true);

        $this->SetLineWidth(0.5);
        $this->Line(10, 287, 200, 287);
    }

    function StyledCell($width, $height, $text, $border, $ln, $align, $fill)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 33, 68);
        $this->Cell($width, $height, $text, $border, $ln, $align, $fill);
    }

    function ValueCell($width, $height, $text, $border, $ln, $align, $fill)
    {
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(0, 0, 0); 
        $this->Cell($width, $height, $text, $border, $ln, $align, $fill);
    }
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);


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
    'Boarding Pass' => 'Yes' 
];

foreach ($ticket as $key => $value) {
    $pdf->StyledCell(50, 10, $key . ':', 1, 0, 'L', false);
    $pdf->ValueCell(0, 10, $value, 1, 1, 'L', false);
}

$pdf->Output('D', 'airport_ticket.pdf');
?>
