<?php
require('connexion.php');
require('fpdf/fpdf.php');

$id = $_GET['id'];

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the center of the page
        $this->Cell(0,30,'',0,1,'C');
        // Title
        $this->Cell(0,10,'Facteur',0,1,'C');
        // Line break
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$sql = "SELECT p.*, GROUP_CONCAT(s.nom SEPARATOR '<br>') as paiments
            FROM chantier p
            JOIN administration c ON p.chantierID = c.chantierID
            JOIN paiment s ON c.paimentID = s.paimentID
            WHERE p.chantierID = :id
            LIMIT 1";

$statement = $connection->prepare($sql);
$statement->execute([':id' => $id]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

// Center the text vertically and horizontally on the page
$pdf->Cell(0, 0, '', 0, 1, 'C');
$pdf->MultiCell(0, 10, "Nom: ".$row['nom']."\nville: ".$row['ville']."\nLes paiments: ".$row['paiments']."\nPrix totale: ".(substr_count($row['paiments'], "<br>") + 1) * 300 ." DH",0,'C');

$pdf->Output();
?>

