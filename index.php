<?php

require 'fpdf.php';

$db = new PDO('mysql:host=localhost;dbname=usertbale', 'root','');

//or

// $db = mysqli_connect('localhost','root','','dbname');

class myPDF extends FPDF {
    function header(){
        $this->Image('logo.jpg', 10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'EMPLOYEE DOCUMENTS', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Street Adress Of Employee', 0, 0, 'C');
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial', '',8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/(nb)',0,0,'C');
    }

    function headerTable(){
        $this->SetFont('Times', 'B', 14);
        $this->Cell(20,10,'ID', 1, 0, 'C');
        $this->Cell(20,10,'username', 1, 0, 'C');
        $this->Cell(20,10,'nama', 1, 0, 'C');
        $this->Cell(20,10,'email', 1, 0, 'C');
        $this->Cell(20,10,'nomortelepon', 1, 0, 'C');
        $this->Cell(20,10,'namausaha', 1, 0, 'C');
        $this->Ln();
    }

    function viewTable($db) {
        $this->SetFont('Times', 'B', 12);
        $stmt = $db->query('select * from usertable');
        while($data = $stmt->fetch(PDO ::FETCH_OBJ)){
            $this->Cell(20,10,$data->ID, 1, 0, 'C');
            $this->Cell(20,10,$data->username, 1, 0, 'L');
            $this->Cell(20,10,$data->nama, 1, 0, 'L');
            $this->Cell(20,10,$data->email, 1, 0, 'L');
            $this->Cell(20,10,$data->nomortelepon, 1, 0, 'L');
            $this->Cell(20,10,$data->namausaha, 1, 0, 'L');
            $this->Ln();
        }
    }
} 


$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
?>