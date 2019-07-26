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
			$data = $aux[2] . "/" . $aux[1] . "/" . $aux[0];
		}


    $sql = "UPDATE dadosconsulta SET peso = '$peso', altura = '$altura', dataConsulta = '$data', obs = '$obs', perimetroCefalico = '$perCefalico' WHERE idcon = $id;";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
?>
