<?php
	include("../includes/dbconnection.php");

	$id = isset($_POST['id']) ? $_POST['id'] : null;
	
	$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
		
		$sexo = isset($_POST['option']) ? $_POST['option'] : null;
		$sexo = $sexo == '1' ? 'm' : 'f';
		
		$nasc = isset($_POST['nascimento']) ? $_POST['nascimento'] : null;
		$aux = explode("-", $nasc);
		
		if(sizeof($aux) == 3 ){
		
			$nasc = $aux[2] . "-" . $aux[1] . "-" . $aux[0];
		
		}
		
		$prematuro = isset($_POST['prematuro']) ? $_POST['prematuro'] : null;
		
		$diasPrematuro = null;

		if($prematuro == 'on'){
		
			$prematuro = "1";
			$diasPrematuro = isset($_POST['dias']) ? $_POST['dias'] :"null";
		
		} else {
		
			$prematuro = "0";
			$diasPrematuro = "null";
		
		}
	//echo "$nome, sexo = '$sexo', nascimento = '$nasc', prematuro = '$prematuro', dias = '$diasPrematuro' WHERE id = $id;";
		
	//$sql = "UPDATE TABLE crianca SET(nome = $nome, sexo = $sexo, nascimento = $nasc, prematuro = $prematuro, dias = $diasPrematuro) WHERE id = $id;";
	$sql = "UPDATE dadoscrianca SET nome = '$nome', sexo = '$sexo', nascimento = '$nasc', prematuro = '$prematuro', diasPrematuro = '$diasPrematuro' WHERE idcrian = $id;";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header("Location: ../consultas.php")
?>
