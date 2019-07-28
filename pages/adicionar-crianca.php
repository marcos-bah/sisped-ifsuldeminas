<?php include("includes/checkout.php"); ?>
<!DOCTYPE html>
<html>
<head>

	<title>SISPED - Sistema de Análise de Dados Pediátricos</title>
	<meta charset="UTF-8">
	<link rel="icon" href="../images/sisped.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- INCLUDE W3 CSS -->
	<link rel="stylesheet" href="../css/w3.css">

	<!-- INCLUDE W3 JS -->
	<script src="../js/w3.js"></script>

	<!-- INCLUDE Font Raleway -->
	<link rel="stylesheet" href="../css/fontRaleway.css">

	<!-- INCLUDE Font Awesome -->
	<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">

	<!-- INCLUDE JQuery Library -->
	<script src="../js/jquery-3.3.1.min.js"></script>

	<!-- INCLUDE Jquery MASK for Inputs Fields -->
	<script src="../js/jquery.mask.min.js"></script>

	<!-- INCLUDE JQuery UI Lib -->
	<script src="../js/jquery-ui.min.js"></script>

	<!-- INCLUDE SISPED CSS -->
	<link rel="stylesheet" href="../css/sisped.css">

	<!-- INCLUDE JQuery UI CSS -->
	<link rel="stylesheet" href="../css/jquery-ui.min.css">


	<style>

		html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
		.editRemoveButton{
			height: 28px;
			margin: 0px;
		}
		.editRemoveIcon{
			vertical-align: top;
		}

	</style>

</head>

<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-green w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();" id="sideMenuCollapseButton"><i class="fa fa-bars"></i>  Menu</button>
  <!--<span class="w3-bar-item w3-right">Sistema de Análise de Dados Pediátricos</span>-->
  <a href="includes/exit.php" class="w3-bar-item w3-right w3-button"><i class="fa fa-sign-in"></i></a>
  <a href="#" class="w3-bar-item w3-right w3-button"><i class="fa fa-wrench"></i></a>
</div>

<script type="text/javascript">
	function habilitar(){
		if (document.getElementById('prematuro').checked){
						 document.getElementById('dias').disabled = false;
						 document.getElementById('dias').value = 1;

		}else {
						 document.getElementById('dias').disabled = true;
						 document.getElementById('dias').value = 0;
		}
	}
</script>


<!-- Sidebar/menu -->

<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar">
	<br />
	<div class="w3-container w3-row">

	<!-- SISPED logo -->
	<div class="w3-col s4">
		<img src="../images/sisped-logo.png" style="height:140px">
	</div>

	</div>
	<hr>
	<div class="w3-container">
	<h5>IFSULDEMINAS</h5>
	</div>

	<!-- Menu/OPTIONS -->
	<div class="w3-bar-block">
	<a href="consultas.php" class="w3-bar-item w3-button w3-padding">
		<i class="fa fa-stethoscope fa-fw"></i> Consultas
	</a>
	<a href="#" class="w3-bar-item w3-button w3-padding w3-red">
		<i class="fa fa-child"></i> Adicionar Criança
	</a>
	<a href="./login.php" class="w3-bar-item w3-button w3-padding">
		<i class="fa fa-sign-out fa-fw"></i>Sair
	</a>
	<br /><br />
	</div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Content Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b></b></h5>
  </header>


	<div class="w3-container">

	  <!-- Painel Adicionar -->

	  <?php
	  if($_POST){
		$nome = isset($_POST['nome']) ? $_POST['nome'] : null;

		$sexo = isset($_POST['option']) ? $_POST['option'] : null;
		$sexo = $sexo == '1' ? 'm' : 'f';

		$nasc = isset($_POST['nasc']) ? $_POST['nasc'] : null;
		$aux = explode("/", $nasc);

		if(sizeof($aux) == 3 ){

			$nasc = $aux[2] . "-" . $aux[1] . "-" . $aux[0];

		}

		$prematuro = isset($_POST['prematuro']) ? $_POST['prematuro'] : null;

		$diasPrematuro = null;


		if($prematuro == 'on'){

			$prematuro = "1";
			$diasPrematuro = isset($_POST['dias']) ? $_POST['dias'] :"0";

		} else {

			$prematuro = "0";
			$diasPrematuro = "0";

		}



		//------------------------------------------------------------------------------
		include("includes/dbconnection.php");

		$sql = "INSERT INTO dadoscrianca (nome, sexo, nascimento, prematuro, diasPrematuro) VALUES ('$nome', '$sexo', '$nasc', $prematuro, $diasPrematuro)";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		}
	  ?>

		<!-- dados inválidos permitidos, requer correção -->

	  <div id="PainelAdicionar" class="w3-container contentPanel w3-card-4 w3-animate-opacity">

		<h2>Adicionar Criança</h2>

		<form id="formCon" class="w3-container" style=" background-color:#fff;" action="adicionar-crianca.php" method="post">

		<br/>

		<div class="w3-row-padding">

			<div class="w3-half">

				  <label class="w3-text-red"><b>Nome: </b></label>
				  <input class="w3-input w3-border w3-border-blue-gray" type="text"  autocomplete="off" name="nome" placeholder="Nome da criança..." required>

			</div>

			<div class="w3-half">

				  <label class="w3-text-red"><b>Sexo: </b></label>
				  <select class="w3-select w3-border w3-border-blue-gray" name="option" required>
					<option value="" disabled selected>Escolha..</option>
					<option value="1">Menino</option>
					<option value="2">Menina</option>
				  </select>

			</div>

		</div>

		<br />

		<div class="w3-row-padding">

			<div  class="w3-col" style="width:160px">
				<label class="w3-text-red"><b>Nascimento: </b></label>
				<input class="w3-input w3-border w3-border-blue-gray campoData" type="date" name="nasc" required> <!-- type = date -->
			</div>

			<div class="w3-col" style="width:160px">
				<br />
				<label for="prematuro">Prematuro</label>
				<input type="checkbox" onclick="habilitar();" class="myCheckBox w3-bottombar w3-bottom" style="top:100px;" name="prematuro" id="prematuro">

			</div>

			<div class="w3-col" style="width:170px">
				  <label class="w3-text-red"><b>Dias (se prematuro): </b></label>
				  <input id="dias" class="w3-input w3-border w3-border-blue-gray" type="number" name="dias" min="1" disabled>
			</div>

		</div>

		<br />
		<br />

		<div class="w3-center">
			<button onclick="enviar()" class="w3-btn w3-border w3-border-red w3-round w3-pale-red"><b>Confirma</b></button>
		</div>

		<br />

		</form>

	  </div>

	   <!-- END of Painel Adicionar -->


  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-center w3-light-grey">
    <p><img src="../images/ifsuldeminas.png" height="40" /></p>
  </footer>


</div>
<!-- End page content -->


<script>
	// Get the Sidebar
	var mySidebar = document.getElementById("mySidebar");

	// Get the DIV with overlay effect
	var overlayBg = document.getElementById("myOverlay");

	//
	var toolTipListarCriancas = true;

	// Toggle between showing and hiding the sidebar, and add overlay effect
	function w3_open() {
		if (mySidebar.style.display === 'block') {
			mySidebar.style.display = 'none';
			overlayBg.style.display = "none";
		} else {
			mySidebar.style.display = 'block';
			overlayBg.style.display = "block";
		}
	}

	// Close the sidebar with the close button
	function w3_close() {
		mySidebar.style.display = "none";
		overlayBg.style.display = "none";
	}
	
</script>

<!-- Fields formating -->
<script>
	$(document).ready(function(){

		//Formata campos de 'DATA' e 'PREMATURO' da aba 'Editar'
		/*$('.campoData').datepicker({dateFormat: 'dd/mm/yyyy'});
		$('.campoData').mask("99/99/9999", {placeholder:"__/__/____"});*/

		$( ".myCheckBox" ).checkboxradio();});
</script>
<!-- END of Fields formating -->

</body>
</html>
