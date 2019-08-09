<?php
require('fpdf/fpdf.php');

$id = $_GET['q'];
$vetEstados = array("Acre", "Alagoas", "Amazonas", "Amapá", "Bahia", "Ceará", "Distrito Federal", "Espírito Santo", "Goiás", "Maranhão", "Mato Grosso", "Mato Grosso do Sul", "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí", "Rio de Janeiro", "Rio Grande do Norte", "Rondônia", "Rio Grande do Sul", "Roraima", "Santa Catarina", "Sergipe", "São Paulo", "Tocantins");
$hash = strval($_SERVER['SERVER_NAME'])."?hash=".strval(md5($id.$vetEstados[rand(0,25)])).strval(11);
     
// outputs image directly into browser, as PNG stream 
include('phpqrcode/qrlib.php'); 
<<<<<<< HEAD:pages/report/report-sisped.php
$image = strval(rand(1,100)+rand(1,100)+rand(1,33)+rand(1,33));
QRcode::png("SISPED Projeto 2019", "tmp/".$image."-qr.png", QR_ECLEVEL_L, 4, 5);

//consulta sql
include("../includes/dbconnection.php");
$sql = "SELECT * FROM dadosconsulta where idCrianca = $id order by dataConsulta desc limit 17";
=======
$image = strval(rand(1,100).rand(1,100).rand(1,33).rand(1,33));
QRcode::png($hash, "tmp/".$image."-qr.png", QR_ECLEVEL_L, 4, 5);

//consulta sql
include("../includes/dbconnection.php");
$sql = "SELECT * FROM dadosconsulta where idCrianca = $id order by dataConsulta desc";
>>>>>>> 5f5e8e24dce5b8b41df94e5ce3bf76302edaeb84:pages/report/report-sisped.php
$result = $conn->query($sql);
$lines = array();

    while($row = $result->fetch_array())
        {
            array_push($lines, $row['dataConsulta'].",".$row['peso'].",".$row['altura'].",".$row['perimetroCefalico'].",".$row['obs']."\n");
        }

<<<<<<< HEAD:pages/report/report-sisped.php
$sql = "SELECT instituicao.nome, instituicao.endereco, instituicao.cnpj, dadoscrianca.nome, dadoscrianca.sexo, dadosauxiliar.nome, dadosauxiliar.crm, dadoscrianca.prematuro  FROM `instituicao` inner join `dadosauxiliar` inner join `dadosconsulta` inner join dadoscrianca on idinst = idinstituicao and idaux = idauxiliar and idcrianca = $id LIMIT 1";
=======
$sql = "SELECT instituicao.nome, instituicao.endereco, instituicao.cnpj, dadoscrianca.nome, dadoscrianca.sexo, 
dadosauxiliar.nome, dadosauxiliar.crm, dadoscrianca.prematuro  FROM `instituicao` inner join `dadosauxiliar` 
inner join `dadosconsulta` inner join dadoscrianca on idinst = idinstituicao and idaux = idauxiliar and idCrianca = idcrian where idcrian = $id 
LIMIT 1";

>>>>>>> 5f5e8e24dce5b8b41df94e5ce3bf76302edaeb84:pages/report/report-sisped.php
$result = $conn->query($sql);

while($row = $result->fetch_array())
        {
            $nomeInst = $row['0'];
            $nomeCrian = $row['3'];
            $nomeMedico = $row['5'];
            $crm = $row['6'];
            $prematuroCrian = ($row['7'] == 1) ? "Sim" : "Não" ;
            $enderecoInst = $row['1'];
            $sexo = ($row['4'] == "m") ? "Masculino" : "Feminino" ;
            $cnpj = $row['2'];             
        }
 
mysqli_close($conn);

//Include the code
include('phplot/phplot.php');

//create a PHPlot object with pixel image
$plot = new PHPlot(1080,620);

$plot->SetFont('title', 5, 18);

//Define some data
$example_data = array(
<<<<<<< HEAD:pages/report/report-sisped.php
     array('a',5),
     array('b',5.2),
     array('c',6),
     array('d',6.4),
     array('e',6.8),
     array('f',7),
     array('g',7.1)
);
$plot->SetDataValues($example_data);

//Set titles
$plot->SetTitle("SISPED Chart \nMade with PHPlot");
$plot->SetXTitle('X Data');
$plot->SetYTitle('Y Data');

=======
     array('a',1),
     array('b',1.5),
     array('c',1.75),
     array('d',1.825),
     array('e',2),
     array('f',2.5),
     array('g',2.6)
);

$plot->SetDataValues($example_data);
$plot->SetDataColors('red');

//Set titles
$plot->SetTitle(utf8_decode("Gráfico SISPED"));
$plot->SetXTitle('X Data');
$plot->SetYTitle('Y Data');

# Draw both grids:
$plot->SetDrawXGrid(True);
$plot->SetDrawYGrid(True);

>>>>>>> 5f5e8e24dce5b8b41df94e5ce3bf76302edaeb84:pages/report/report-sisped.php
//Turn off X axis ticks and labels because they get in the way:
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

$plot->SetIsInline(True);
$plot->SetOutputFile("tmp/test.png"); 

//Draw it
$plot->DrawGraph();



class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        $this->Image('image/if.png',null,5,17);
        // Times bold 15
        $this->Image('image/sisped-logo2.png',255,9,30);
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
    function LoadData($lines)
    {
        // Read file lines
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
        $cont = 0;
        foreach($data as $row)
        {
            $cont++;
            $this->Cell(5);
            $this->Cell($w[0],6,utf8_decode($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,utf8_decode($row[1]),'LR',0,'C',$fill);
            $this->Cell($w[2],6,utf8_decode($row[2]),'LR',0,'C',$fill);
            $this->Cell($w[3],6,utf8_decode($row[3]),'LR',0,'C',$fill);
            $this->Cell($w[4],6,utf8_decode($row[4]),'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
            if($cont>=30){ //resolver o alocamneto de consultas no pdf
                $this->AddPage();
                $cont = 0;
                $this->Ln(15);
            }
        }
        // Closing line
        $this->Cell(5);
        $this->Cell(array_sum($w),0,'','T');
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Times','',8);
        $this->Image('image/sisped-logo2.png', 10,280,30);
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
$pdf->Cell(20,5,utf8_decode('Prematuro: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,5,utf8_decode($prematuroCrian),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','B',12);
$pdf->Cell(23,5,utf8_decode('Sexo: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(20,5,utf8_decode($sexo),0,1);

$pdf->Ln(2);

$pdf->Rect(10,67,190,7.5);

$pdf->SetFont('Times','B',12);
$pdf->Cell(20,10,utf8_decode('Médico: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,10,$nomeMedico,0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10,10,utf8_decode('CRM: '),0,0);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(20,10,utf8_decode($crm),0,1);

$pdf->Ln(1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(0,10,'Consultas ',0,1);
$header = array('Data', 'Peso (kg)', 'Altura (cm)', 'Perimetro*', 'Observações*');
// Data loading
$data = $pdf->LoadData($lines);
$pdf->SetFont('Times','',11);
$pdf->Cell(5);
$pdf->FancyTable($header,$data);

$pdf->Ln(13);

$pdf->SetDrawColor(0,0,0);
$pdf->SetFont('Times','',10);
$pdf->Rect(140,215,60,60);
$pdf->Image("tmp/".$image.'-qr.png',145,220,50);
$pdf->SetY(-82);
<<<<<<< HEAD:pages/report/report-sisped.php
$pdf->Cell(0,5,utf8_decode('¹ Perímetro se refere ao perímetro cefálico, logo, a circunferência do encéfalo.'),0,1);
$pdf->Cell(0,5,utf8_decode('² Observações são submetidas pelos pediatras.'),0,1);
$pdf->Cell(0,5,utf8_decode('³ Este documento pode ser autenticado a qualquer momento pelo QR Code ao lado.'),0,1);
=======
$pdf->Cell(0,5,utf8_decode('¹ Perimetro se refere ao perimetro cefalico, logo, a circunferencia do encefalo.'),0,1);
$pdf->Cell(0,5,utf8_decode('² Situação é determinada pelo algoritmo que avalia caso a caso os dados obtidos.'),0,1);
$pdf->Cell(0,5,utf8_decode('³ Esse documento pode ser autenticado a qualquer momento pelo QR Code ao lado.'),0,1);
>>>>>>> 5f5e8e24dce5b8b41df94e5ce3bf76302edaeb84:pages/report/report-sisped.php

$pdf->Ln(36);
$pdf->Cell(20);

$pdf->SetFont('Times','',12);
$pdf->Cell(100,10,utf8_decode("Profissional Responsável"),'T',0,'C');

$pdf->AddPage("L");

$pdf->SetFont('Times','B',14);
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode('Gráficos '),0,1);
$pdf->Image('tmp/test.png',10,40,280);

$pdf->Output();

unlink("tmp/".$image."-qr.png");
?>
