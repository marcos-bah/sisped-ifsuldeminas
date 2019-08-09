<?php
	include("../includes/dbconnection.php");

	$id = isset($_GET['id']) ? $_GET['id'] : null;

	$sql ="SET SQL_SAFE_UPDATES = 0;";
	$sql .= "DELETE FROM `dadosconsulta` WHERE idCrianca = $id;";
	$sql .= "DELETE FROM `dadoscrianca` WHERE idcrian = $id;";
	$sql .="SET SQL_SAFE_UPDATES = 1;";
	
	mysqli_multi_query($conn,$sql);
	mysqli_close($conn);
	
	echo json_encode(true);
?>
