<?php
    include("../includes/dbconnection.php");
    $id = (!empty($_POST['id'])) ? $_POST['id'] : "NULL" ;
    $perCefalico = (!empty($_POST['perCefalico'])) ? $_POST['perCefalico'] : "NULL" ;
    $peso = (!empty($_POST['peso'])) ? $_POST['peso'] : "NULL" ;
    $altura = (!empty($_POST['altura'])) ? $_POST['altura'] : "NULL" ;
    $data = (!empty($_POST['dataConsulta'])) ? $_POST['dataConsulta'] : "NULL" ;
    $obs = $_POST['obs'];
    if (!$obs) {
      $obs = "Sem Observações";
    }
    
    $aux = explode("/", $data);

    if(sizeof($aux) == 3 ){
      $data = $aux[2]."-". $aux[1]."-".$aux[0];
    }

    $sql = "UPDATE dadosconsulta SET peso = $peso, altura = $altura, dataConsulta = '$data', obs = '$obs', perimetroCefalico = $perCefalico WHERE idcon = $id;";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
?>
