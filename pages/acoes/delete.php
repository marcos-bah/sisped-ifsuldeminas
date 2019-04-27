<?php
	include("../includes/dbconnection.php");

	$id = isset($_GET['id']) ? $_GET['id'] : null;


	//echo "$nome, sexo = '$sexo', nascimento = '$nasc', prematuro = '$prematuro', dias = '$diasPrematuro' WHERE id = $id;";

	//$sql = "UPDATE TABLE crianca SET(nome = $nome, sexo = $sexo, nascimento = $nasc, prematuro = $prematuro, dias = $diasPrematuro) WHERE id = $id;";
	$sql ="SET SQL_SAFE_UPDATES = 0;";
	$sql .= "DELETE FROM `dadosconsultas` WHERE codCrianca = $id;";
	$sql .= "DELETE FROM `dadoscrianca` WHERE id = $id;";
	$sql .="SET SQL_SAFE_UPDATES = 1;";
	
	mysqli_multi_query($conn,$sql);
	mysqli_close($conn);
	
	echo json_encode(true);
?>
