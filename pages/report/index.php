<?php
/* Carrega a classe DOMPdf */
require_once("dompdf/dompdf_config.inc.php");

/* Faz as consultas SQL para alimentar o relatorio */
$nomeInst = "APAE IFSULDEMINAS P. P. E.";
$cnpjInst = "81.012.501/0001-90";
$endeInst = "Rua XV Novembro";

$nomeCrian = "Criança Número Um";
$idenCrian = "0001";
$nascCrian = "21/02/2005";
$premCrian = "Não";
$respCrian = "Responável Crinça Número Um";
$respCpfCrian = "613.419.810-29";

$dados = ['22/05/2006', '22', '132', '17', '39', 'Dr. Douglas','22/05/2006', '22', '132', '18', '39', 'Dr. Douglas','22/05/2006', '22', '132', '17', '39', 'Dr. Douglas','22/05/2006', '22', '132', '18', '39', 'Dr. Douglas','22/05/2006', '22', '132', '17', '39', 'Dr. Douglas','22/05/2006', '22', '132', '18', '39', 'Dr. Douglas'];

/* Cria a instância */
$dompdf = new DOMPDF();

$html = "

<style>
    *{font-family: 'Times New Roman', Times, serif;};
    h1{margin-top: -20px; font-size: 25px;};
    #customers {
        border-collapse: collapse;
        width: 100%;
      }
      
      #customers td, #customers th {
        border: 1px;
        padding: 8px;
        width: 100px;
      }
      
      #customers tr:nth-child(even){background-color: #f2f2f2;}
      
      #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
      }
</style>

<div id='content'>
    <h1 style='margin-top: -15px; font-size: 25px;'>SISPED: Sistema de Análises de Dados Pediatricos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='sisped-logo.png' width='100' height='50'></h1>
        <table>
            <tr>
                <td style='width: 400px; text-align: left;'><span style='font-weight: bold'>INSTITUIÇÃO: </span>".$nomeInst."</td>
                <td><span style='font-weight: bold'>CNPJ: </span>".$cnpjInst."</td>
            </tr>
            <tr>
                <td style='width: 400px; text-align: left;'><span style='font-weight: bold'>ENDEREÇO: </span>".$endeInst."</td>
            </tr>
            <tr>
                <td>___________</td><td>___________</td>
            </tr>
            <tr>
                <td style='width: 400px; text-align: left;'><span style='font-weight: bold'>CRIANÇA: </span>".$nomeCrian."</td>
                <td><span style='font-weight: bold'>DATA DE NASCIMENTO: </span>".$nascCrian."</td>
            </tr>
            <tr>
                <td style='width: 400px; text-align: left;'><span style='font-weight: bold'>ENDEREÇO: </span>".$endeInst."</td>
                <td><span style='font-weight: bold'>PREMATURO: </span>".$premCrian."</td>
            </tr>
            <tr>
                <td>___________</td><td>___________</td>
            </tr>
            <tr>
                <td style='width: 400px; text-align: left;'><span style='font-weight: bold'>RESPONSÁVEL: </span>".$respCrian."</td>
                <td><span style='font-weight: bold'>CPF: </span>".$respCpfCrian."</td>
            </tr>
        </table> <br> <br>

        <table id='customers'>
            <tr>
                <th>Data Consulta</th>
                <th>Peso</th>
                <th>Altura</th>
                <th>IMC</th>
                <th>P. Céfalico</th>
                <th>R. Médico</th>
            </tr><tr>";

for ($i=0; $i < sizeof($dados); $i++) { 
    if($i%6==0 and $i != 0){
        $html .="</tr><tr>";
    }
    $html .= "<td>".$dados[$i]."</td>";
}

$html .= "</tr></table></div>";

$html .= "
    <footer style='position: fixed; bottom: 50; text-align: left;'><img src='testeqr.png' width='100' height='100'>&nbsp;&nbsp;&nbsp;&nbsp;<span style='border-top: 1px solid #222; font-style: italic; padding: 30px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Assinatura Pediatra / Médico&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></footer>
";

/* Carrega seu HTML */
$dompdf->load_html($html);

/* Renderiza */
$dompdf->render();

/* Exibe */
$dompdf->stream(
    "saida.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);
?>


