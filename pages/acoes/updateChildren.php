<?php
	include("../includes/dbconnection.php");

	$id = isset($_POST['id']) ? $_POST['id'] : null;
	
	$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
		
	$sexo = isset($_POST['option']) ? $_POST['option'] : null;

	$sexo = $sexo == '1' ? 'm' : 'f';
	
	$nasc = isset($_POST['nascimento']) ? $_POST['nascimento'] : null;

	$aux = explode("-", $nasc);
	
	if(sizeof($aux) == 3 ){
		$nasc = $aux[0] . "-" . $aux[1] . "-" . $aux[2];
	}
	
	$prematuro = isset($_POST['prematuro']) ? $_POST['prematuro'] : null;
	
	$diasPrematuro = isset($_POST['dias']) ? $_POST['dias'] : "0";
	
	
	$sql = "UPDATE dadoscrianca SET nome = '$nome', sexo = '$sexo', nascimento = '$nasc', diasPrematuro = '$diasPrematuro' WHERE idcrian = $id;";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header("Location: ../consultas.php");
?>
