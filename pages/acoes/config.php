<?php
    include("../includes/dbconnection.php");
    $inst = (!empty($_POST['inst'])) ? $_POST['inst'] : "Local" ;
    $end = (!empty($_POST['end'])) ? $_POST['end'] : "Local" ;
    $cnpj = (!empty($_POST['cnpj'])) ? $_POST['cnpj'] : "0000-00" ;
    $nomeaux = (!empty($_POST['nomeaux'])) ? $_POST['nomeaux'] : "Auxiliar" ;
    $cpf = (!empty($_POST['cpf'])) ? $_POST['cpf'] : "00000000" ;
    $crm = (!empty($_POST['crm'])) ? $_POST['crm'] : "00000" ;
    $user = (!empty($_POST['user'])) ? $_POST['user'] : "admin" ;
    $senha = (!empty($_POST['senha'])) ? $_POST['senha'] : NULL ;
    $aut = (!empty($_POST['aut'])) ? $_POST['aut'] : "NULL" ;

    $sql = "SELECT password from sispeduser";
    $result = $conn->query($sql);
    $r = $result->fetch_all();

    if(sha1(md5($aut)) != $r[0][0]){
        echo json_encode('Senhas Diferentes!');
        exit();
    }

    if(!empty($senha)){
        $senha = sha1(md5($senha));
        $sql1 = "UPDATE `instituicao` SET `nome` = '$inst', `cnpj` = '$cnpj', `endereco` = '$end' WHERE `instituicao`.`idinst` = 1;";
        $sql2 = "UPDATE `dadosauxiliar` SET `nome` = '$nomeaux', `crm` = '$crm', `cpf` = '$cpf' WHERE `dadosauxiliar`.`idaux` = 1;"; 
        $sql3 = "UPDATE `sispeduser` SET `nameuser` = '$user', `password` = '$senha' WHERE `sispeduser`.`iduser` = 1 ";
    }else{
        $sql1 = "UPDATE `instituicao` SET `nome` = '$inst', `cnpj` = '$cnpj', `endereco` = '$end' WHERE `instituicao`.`idinst` = 1;"; 
        $sql2 = "UPDATE `dadosauxiliar` SET `nome` = '$nomeaux', `crm` = '$crm', `cpf` = '$cpf' WHERE `dadosauxiliar`.`idaux` = 1;"; 
        $sql3 = "UPDATE `sispeduser` SET `nameuser` = '$user' WHERE `sispeduser`.`iduser` = 1";
    }

    echo json_encode('Alterado com Sucesso!');

    mysqli_query($conn, $sql1);
    mysqli_query($conn, $sql2);
    mysqli_query($conn, $sql3);
    mysqli_close($conn);
?>