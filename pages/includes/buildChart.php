<?php

$fileName = $_GET['name']; //recebe o nome do arquivo csv para obter os dados
$handle = fopen($fileName, "r");

$cabecalho  = fgetcsv($handle, 1000, ";"); //para que o codigo seja dinamico, ele procura o indice de cada coluna
for ($i = 0; $i < count($cabecalho); $i++){
	if ($cabecalho[$i] == "Week" or $cabecalho[$i] == "Month" or $cabecalho[$i] == "Height" or $cabecalho[$i] == "Length" or $cabecalho[$i] == "Years" or $cabecalho[$i] == "Idade(meses)" or  $cabecalho[$i] == "Idade(anos)"){ // o x muda em diferentes tipos de charts
		$idenM = $i;
	}elseif ($cabecalho[$i] == "SD3neg" or $cabecalho[$i] == "P3" or $cabecalho[$i] == "3.00%" or $cabecalho[$i] == "3,00%") {
		$idenSD3n = $i;
	}elseif ($cabecalho[$i] == "SD2neg" or $cabecalho[$i] == "P15" or $cabecalho[$i] == "10.00%" or $cabecalho[$i] == "10,00%") {
		$idenSD2n = $i;
	}elseif ($cabecalho[$i] == "SD1neg" or $cabecalho[$i] == "P25" or $cabecalho[$i] == "25.00%" or $cabecalho[$i] == "25,00%") {
		$idenSD1n = $i;
	}elseif ($cabecalho[$i] == "SD0" or $cabecalho[$i] == "P50" or $cabecalho[$i] == "50.00%" or $cabecalho[$i] == "50,00%") {
		$idenSD0 = $i;
	}elseif ($cabecalho[$i] == "SD3" or $cabecalho[$i] == "P97" or $cabecalho[$i] == "97.00%" or $cabecalho[$i] == "97,00%") {
		$idenSD3 = $i;
	}elseif ($cabecalho[$i] == "SD2" or $cabecalho[$i] == "P85" or $cabecalho[$i] == "90.00%" or $cabecalho[$i] == "90,00%") {
		$idenSD2 = $i;
	}elseif ($cabecalho[$i] == "SD1" or $cabecalho[$i] == "P75" or $cabecalho[$i] == "75.00%" or $cabecalho[$i] == "75,00%") {
		$idenSD1 = $i;
	}
}

$row = 0;

while ($line = fgetcsv($handle, 1000, ";")) { //comeca a obter os dados

    $meses[] = $line[$idenM];
	$SD3neg[] = $line[$idenSD3n];
	$SD2neg[] = $line[$idenSD2n];
	$SD1neg[] = $line[$idenSD1n];
	$SD0[] = $line[$idenSD0];
	$SD3[] = $line[$idenSD3];
	$SD2[] = $line[$idenSD2];
	$SD1[] = $line[$idenSD1];

	if ($row++ == 0) {
		continue;
	}

}

include("initChart.php");

$k = count($meses);
fclose($handle); // fecha o arquivo

if ($set) {
	if ($time == 'semanas') {
		$set = round($set/7);
	}else{
		if($set >= 30 and $set < 60){
			$set = 1;
		}elseif ($set >= 60) {
			$set = 2;
		}
	}
}


$res['meses'] = $meses; // cria um espécie de dicionário
$res['k'] = $k;
$res['SD3neg'] = $SD3neg ;
$res['SD2neg'] = $SD2neg ;
$res['SD1neg'] = $SD1neg ;
$res['SD0'] = $SD0 ;
$res['SD3'] = $SD3 ;
$res['SD2'] = $SD2;
$res['SD1'] = $SD1 ;
$res['grafico_name'] = $fileName;
$res['dataCrianca'] = $dataCrianca;
$res['tempo'] = $tempo;
$res['tipo'] = $pesquisa;

echo json_encode($res); // devolve a chamada getJSON

 ?>
