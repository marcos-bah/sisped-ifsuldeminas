<?php

error_reporting(0);
ini_set(“display_errors”, 0 );

require('fpdf/fpdf.php'); // biblioteca para gerar o pdf
include("sisped.php"); // funcoes para gerar o grafico
include('phpqrcode/qrlib.php'); // outputs image directly into browser, as PNG stream 
include("../includes/dbconnection.php"); // funcoes para se conectar ao banco de dados
include('phplot/phplot.php'); // biblioteca para geracao de graficos

$qr = false; //gera o qr

$id = $_GET['id']; // identificador da crianca

$atual = new DateTime();
$atual = str_replace(" ", "", $atual->format('d-m-Y H:i:s'));
$atual = str_replace(":", "", $atual);

$chartName = $id.$atual;
$limite1 = 22;
$limite2 = 30;

if($qr){
    $cod = sha1($id.$atual); 
    $hash = "https://urso-sisped.000webhostapp.com?q=".$cod; // hash com a validacao do relatorio
    $image = $id.$atual; // filename da imagem a ser gerado pela biblioteca de QR Code
    QRcode::png($hash, "tmp/".$image."-qr.png", QR_ECLEVEL_L, 4, 5);
    $limite1 = 18;
    $limite2 = 28;
}  

// inicio das consultas ao banco de dados
$sql = "SELECT * FROM dadosconsulta where idCrianca = $id order by dataConsulta desc"; // retorna dados referentes a crinca, dados das consultas
$result = $conn->query($sql);
$lines = array();

while($row = $result->fetch_array()){
    array_push($lines, $row['dataConsulta'].",".$row['peso'].",".$row['altura'].",".$row['perimetroCefalico'].",".$row['obs']."\n");
}

$sql = "SELECT instituicao.nome, instituicao.endereco, instituicao.cnpj, dadoscrianca.nome, dadoscrianca.sexo, 
dadosauxiliar.nome, dadosauxiliar.crm, dadoscrianca.diasPrematuro  FROM `instituicao` 
inner join `dadosauxiliar` 
inner join `dadosconsulta` 
inner join dadoscrianca 
on idinst = idinstituicao and idaux = idauxiliar and idCrianca = idcrian where idcrian = $id LIMIT 1"; //retorna dados da instituicao e crianca

$result = $conn->query($sql);

while($row = $result->fetch_array())
        {
            $nomeInst = $row['0'];
            $nomeCrian = $row['3'];
            $nomeMedico = $row['5'];
            $crm = $row['6'];
            $prematuroCrian = ($row['7'] > 0) ? "Sim" : "Não" ;
            $enderecoInst = $row['1'];
            $sexo = ($row['4'] == "m") ? "Masculino" : "Feminino" ;
            $cnpj = $row['2'];             
        }
 
mysqli_close($conn);

function chart($dataCrianca, $x, $y, $chartName){

    global $nomeCrian;

    //create a PHPlot object with pixel image
    $plot = new PHPlot(1480,720);

    $plot->SetXScaleType("linear");
    $plot->SetXDataLabelType('custom');
    $plot->SetFont('title', 5, 18);
    $plot->SetFont('y_label', 5, 18);
    //$plot->SetFont('y_title', 5, 18);
    //$plot->SetFont('x_title', 5, 18);
    
    $plot->SetFontTTF('y_title', 'C:\WINDOWS\FONTS\ARIAL.TTF', 14);
    $plot->SetFontTTF('x_title', 'C:\WINDOWS\FONTS\ARIAL.TTF', 18);
    $plot->SetFontTTF('title', 'C:\WINDOWS\FONTS\ARIAL.TTF', 28);
    
    $plot->SetDrawDataBorders(true);
    $plot->SetDataColors(array('black', 'red', 'DarkGreen', 'red', "black", "blue" ));
    $plot->SetPlotType('lines');
    $plot->SetLineStyles(array('solid', 'solid','solid','solid','solid' ,'solid'));
    $plot->SetLineWidths(4);
    $plot->SetLegend(array('SD3', 'SD2', 'SD0', 'SD2neg', 'SD3neg', $nomeCrian));
    $plot->SetLegendPosition(1, 0, 'plot', 1, 0, -10, 500);
    

    $res = parametros($_GET['p']);

    if(count($res['meses'])<=61){
        $plot->SetFont('x_label', 5, 18);
    }else{
        $plot->SetFont('x_label', 3, 18);
    }

    $result = array();
    $validador = (count($res['meses'])>61) ? true : false ;

    for ($i=0; $i < count($res['meses']); $i++) { 
        if(!isset($dataCrianca[$i])){
            $dataCrianca[$i] = null;
        }
        if($validador){
            if(!($i%3==0)){
                $res['meses'][$i] = " ";
            }
        }
        $aux = array();
        array_push($aux, $res['meses'][$i], $res['SD3'][$i], $res['SD2'][$i], $res['SD0'][$i], $res['SD2neg'][$i], $res['SD3neg'][$i], $dataCrianca[$i]);
        array_push($result, $aux);
    }

    //Define some data
    $plot->SetDataValues($result);

    //Set titles

    $plot->SetTitle(str_replace("/", " - ", str_replace(".csv", "", substr($res['grafico_name'], 10))));
    $plot->SetXTitle($x);
    $plot->SetYTitle($y, 'both');


    $plot->SetXTickLabelPos('none');
    $plot->SetXTickPos('none');

    $plot->SetIsInline(True);
    $plot->SetOutputFile("tmp/".$chartName.".png"); 

    //Draw it
    $plot->DrawGraph();
}

chart($dataCrianca, $tempo, $_GET['pesq'], $chartName);

class PDF extends FPDF{
    // Page header
    function Header(){
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
    function LoadData($lines){
        // Read file lines
        $data = array();
        foreach($lines as $line)
            $data[] = explode(',',trim($line));
        return $data;
    }

    //generateTable
    function FancyTable($header, $data){
        // Colors, line width and bold font
        global $limite1, $limite2;
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
        $limite = $limite1;
        foreach($data as $row){
            $this->SetDrawColor(0,90,0);
            $cont++;
            
            $this->Cell(5);
            $this->Cell($w[0],6,utf8_decode($row[0]),1,0,'C',$fill);
            $this->Cell($w[1],6,utf8_decode($row[1]),1,0,'C',$fill);
            $this->Cell($w[2],6,utf8_decode($row[2]),1,0,'C',$fill);
            $this->Cell($w[3],6,utf8_decode($row[3]),1,0,'C',$fill);
            $this->Cell($w[4],6,utf8_decode($row[4]),1,0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
            if($cont>=$limite){ //resolver o alocamneto de consultas no pdf
                // Closing line
                footerPage($this);
                $this->AddPage();
                $cont = 0;
                $this->Ln(15);
                $limite = $limite2;
                $this->SetFillColor(0,110,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0,90,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $this->Cell(5);
        $w = array(35, 35, 35, 35, 38);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],6,utf8_decode($header[$i]),1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
            }
        }
        // Closing line
        $this->Cell(5);
        $this->Cell(array_sum($w),0,'','T');
    }

    // Page footer
    function Footer(){
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
$header = array('Data', 'Peso (kg)', 'Altura (cm)', 'Perimetro*', 'Observações*');
// Data loading
$data = $pdf->LoadData($lines);
$pdf->SetFont('Times','',11);
$pdf->Cell(5);
$pdf->FancyTable($header,$data);

$pdf->Ln(13);

function footerPage($pdf){
    global $image, $qr;

    if($qr){
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFont('Times','',10);
        $pdf->Rect(140,215,60,60);
        $pdf->Image("tmp/".$image.'-qr.png',145,220,50);
        $pdf->SetY(-82);

        $pdf->Cell(0,5,utf8_decode('¹ Esse documento pode ser autenticado a qualquer momento pelo QR Code ao lado.'),0,1);
        $pdf->Cell(0,5,utf8_decode('² O documento poderá demorar cerca de 24 horas para poder ser autenticado.'),0,1);
        $pdf->Cell(0,5,utf8_decode('³ Verifique se essa unidade possui suporte para validação QR.'),0,1);
        $pdf->Ln(36);
        $pdf->Cell(25);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(100,10,utf8_decode("Profissional Responsável"),'T',0,'C');
    }

    
}

footerPage($pdf);

function chartPage($pdf, $chartName){ //geracao de pagina com grafico
    $pdf->AddPage("L");

    $pdf->SetFont('Times','B',14);
    $pdf->Ln(10);
    $pdf->Cell(0,10,utf8_decode('Gráficos '),0,1);
    $pdf->Image('tmp/'.$chartName.'.png',10,40,280);
}


chartPage($pdf, $chartName);

$pdf->Output();

unlink("tmp/".$image."-qr.png");
unlink("tmp/".$chartName.".png");
?>
