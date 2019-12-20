<?php
    include("../includes/dbconnection.php");
    $sql = "SELECT dadosauxiliar.nome, crm, cnpj, instituicao.nome, endereco, nameuser, cpf FROM dadosauxiliar, instituicao, sispeduser";
    $result = $conn->query($sql);
    $res = $result->fetch_all();
    mysqli_close($conn);

    echo json_encode($res);
?>