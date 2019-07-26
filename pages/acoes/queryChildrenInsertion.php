<?php
    include("../includes/dbconnection.php");
    $id = $_POST['id'];
    $perCefalico = $_POST['perCefalico'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $data = $_POST['dataConsulta'];
    $obs = $_POST['obs'];
    if (!$obs) {
      $obs = "Sem Observações";
    }
    
    $aux = explode("/", $data);

		if(sizeof($aux) == 3 ){

			$data = $aux[2]."/". $aux[1]."/".$aux[0];

		}

    $sql = "INSERT INTO dadosconsulta (perimetroCefalico, peso, altura, dataConsulta, idCrianca, idinstituicao, idauxiliar, obs) VALUES ( $perCefalico, $peso, $altura, '$data', $id, 1, 1, '$obs')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
?>
