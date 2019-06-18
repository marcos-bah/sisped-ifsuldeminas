<?php
require('fpdf.php');

//consulta sql
$nomeCrian = "Criança Número Um";
$nomeInst = "APAE BRASIL Federação Nacional das Apaes";
$nomeMedico = "Médico Atual";
$crm = 542344;
$endereçoCrian = "Rua 9 de Julho";
$enderecoInst = "EDIFÍCIO VENÂNCIO IV COBERTURA, CEP: 70393-903, Brasilia/DF";
$sit = "Prematuro";
$cnpj = "62.535.044/0001-73";
$id = 1;


class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        $this->Image('if.png',null,5,17);
        // Times bold 15
        $this->Image('sisped-logo2.png',255,9,30);
        $this->SetFont('Times','B',15);
        // Title
        $this->Cell(25);
        $this->Cell(0,0,utf8_decode("Relatório SISPED"),0,0,'L');
        // Times regular 12
        $this->SetFont('Times','',12);
        $this->Ln(3);
        $this->Cell(25);
        $this->Cell(190,10,utf8_decode("Instituto Federal de Educação, Ciência e Tecnologia do Sul de Minas Gerais (IFSULDEMINAS)"),0,0,'L');
        $this->Ln(6);
        $this->Cell(25);
        $this->Cell(190,10,utf8_decode("Campus Avançado Carmo de Minas"),0,0,'L');
        // Line break
    }

    //loadData
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(',',trim($line));
        return $data;
    }

    //generateTable
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(0,110,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0,90,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(35, 35, 35, 35, 38);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,utf8_decode($header[$i]),1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell(5);
            $this->Cell($w[0],6,utf8_decode($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,utf8_decode($row[1]),'LR',0,'C',$fill);
            $this->Cell($w[2],6,utf8_decode($row[2]),'LR',0,'C',$fill);
            $this->Cell($w[3],6,utf8_decode($row[3]),'LR',0,'C',$fill);
            $this->Cell($w[4],6,utf8_decode($row[4]),'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(5);
        $this->Cell(array_sum($w),0,'','T');
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Times italic 8
        $this->SetFont('Times','',8);
        $this->Image('sisped-logo2.png', 10,280,30);
        // Page number
        //$this->Cell(0,20,utf8_decode("Página: ").$this->PageNo().'',0,0,'R');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Rect(10,33,190,15);

$pdf->Ln(13);

$pdf->SetFont('Times','B',12);
$pdf->Cell(20,10,utf8_decode('Instituição: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,10,utf8_decode($nomeInst),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10,10,utf8_decode('CNPJ: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(20,10,utf8_decode($cnpj),0,1);

$pdf->SetFont('Times','B',12);
$pdf->Cell(20,5,utf8_decode('Endereço: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(0,5,utf8_decode($enderecoInst),0,1);

$pdf->Ln(2);

$pdf->Rect(10,50,190,15);

$pdf->SetFont('Times','B',12);
$pdf->Cell(20,10,utf8_decode('Criança: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,10,utf8_decode($nomeCrian),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','B',12);
$pdf->Cell(23,10,utf8_decode('Identificador: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(20,10,utf8_decode($id),0,1);

$pdf->SetFont('Times','B',12);
$pdf->Cell(20,5,utf8_decode('Endereço: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,5,utf8_decode($endereçoCrian),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','B',12);
$pdf->Cell(23,5,utf8_decode('Situação: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(20,5,utf8_decode($sit),0,1);

$pdf->Ln(2);

$pdf->Rect(10,67,190,7.5);

$pdf->SetFont('Times','B',12);
$pdf->Cell(20,10,utf8_decode('Médico: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,10,utf8_decode($nomeMedico),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10,10,utf8_decode('CRM: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(20,10,utf8_decode($crm),0,1);

$pdf->Ln(1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(0,10,'Consultas ',0,1);
$header = array('Data', 'Peso (kg)', 'Altura (cm)', 'Perimetro*', 'Situação*');
// Data loading
$data = $pdf->LoadData('data.txt');
$pdf->SetFont('Times','',11);
$pdf->Cell(5);
$pdf->FancyTable($header,$data);

$pdf->Ln(13);

$pdf->SetDrawColor(0,0,0);
$pdf->SetFont('Times','',10);
$pdf->Rect(140,215,60,60);
$pdf->Image('qr.png',145,220,50);
$pdf->Cell(0,5,utf8_decode('¹ Perimetro se refere ao perimetro cefalico, logo, a circunferencia do encefalo.'),0,1);
$pdf->Cell(0,5,utf8_decode('² Situação é determinada pelo algoritmo que avalia caso a caso os dados obtidos.'),0,1);
$pdf->Cell(0,5,utf8_decode('³ Esse documento pode ser autenticado a qualquer momento pelo QR Code ao lado.'),0,1);

$pdf->Ln(36);
$pdf->Cell(20);

$pdf->SetFont('Times','',12);
$pdf->Cell(100,10,utf8_decode("Profissional Responsável"),'T',0,'C');

$pdf->AddPage("L");

$pdf->SetFont('Times','B',14);
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode('Gráficos '),0,1);
$pdf->Image('chart.png',10,40,280);

$pdf->Output();
?>