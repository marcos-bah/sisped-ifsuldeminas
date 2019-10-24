<?php
    $filename = "../../config/config.txt";

    if (file_exists($filename)) {
        echo "Configuração já realizada!";
        header("../login.php");
    } else {
        mkdir("../../config/");
        $conteudo = "Inicializando Sistema.\nData: ".date('d/m/y')."\nCriando arquivo de configuração e banco de dados.";
        // Criando o novo arquivo
        echo file_put_contents($filename, $conteudo); 
    }
?>