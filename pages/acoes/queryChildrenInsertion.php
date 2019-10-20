<?php
    include("../includes/dbconnection.php");
    $id = (isset($_POST['id'])) ? $_POST['id'] : null ;
    $perCefalico = (isset($_POST['perCefalico'])) ? $_POST['perCefalico'] : null ;
    $peso = (isset($_POST['peso'])) ? $_POST['peso'] : null ;
    $altura = (isset($_POST['altura'])) ? $_POST['altura'] : null ;
    $data = (isset($_POST['dataConsulta'])) ? $_POST['dataConsulta'] : null ;
    $obs = (isset($_POST['obs'])) ? $_POST['obs'] : "Sem Observações" ;
    
    $aux = explode("-", $data);

		if(sizeof($aux) == 3 ){
			$data = $aux[2]."-". $aux[1]."-".$aux[0];
    }

    $sql = "INSERT INTO dadosconsulta(perimetroCefalico, peso, altura, dataConsulta, idCrianca, idinstituicao, idauxiliar, obs) VALUES ( '$perCefalico', '$peso', '$altura', '$data', $id, 1, 1, '$obs')";
    print_r($sql);
    mysqli_query($conn, $sql);
    mysqli_close($conn);
?>
