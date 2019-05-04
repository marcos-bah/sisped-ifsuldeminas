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
    
    $aux = explode("-", $data);

		if(sizeof($aux) == 3 ){

			$data = $aux[2] . "-" . $aux[1] . "-" . $aux[0];

		}


    $sql = "INSERT INTO dadosconsultas (perimetroCefalico, peso, altura, dataConsulta, codCrianca, obs) VALUES ( $perCefalico, $peso, $altura, '$data', $id, '$obs')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header("Location: ../consultas.php")
?>
