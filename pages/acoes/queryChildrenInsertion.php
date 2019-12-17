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
    
    $aux = explode("-", $data);

    $sql = "INSERT INTO dadosconsulta(perimetroCefalico, peso, altura, dataConsulta, idCrianca, idinstituicao, idauxiliar, obs) VALUES ( $perCefalico, $peso, $altura, '$data', $id, 1, 1, '$obs')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    echo json_encode($sql);
?>
