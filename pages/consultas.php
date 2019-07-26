<?php include("includes/checkout.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>SISPED - Sistema de Análise de Dados Pediátricos</title>
	<meta charset="UTF-8">
	<meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate, Post-Check=0, Pre-Check=0">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<link rel="icon" href="../images/sisped.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- INCLUDE funcoes ifsuldeminas -->
	<script src="../js/funcoes.js"></script>
	<script src="../js/initTable.js"></script>

	<!-- INCLUDE W3 CSS -->
	<link rel="stylesheet" href="../css/w3.css">
	<!-- <link rel="stylesheet" href="../css/select.css"> -->

	<!-- INCLUDE SISPED CSS -->
	<link rel="stylesheet" href="../css/sisped.css">

	<!-- INCLUDE W3 JS -->
	<script src="../js/w3.js"></script>

	<!-- INCLUDE Font Raleway -->
	<link rel="stylesheet" href="../css/fontRaleway.css">

	<!-- INCLUDE custom Pagination Style -->
	<link rel="stylesheet" href="../css/pagination.css">
	<!-- <link rel="stylesheet" href="../css/datatable.min.css"> -->

	<!-- INCLUDE Font Awesome -->
	<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">

	<!-- INCLUDE JQuery Library -->
	<script src="../js/jquery-3.3.1.min.js"></script>

	<!-- INCLUDE JQuery Library -->
	<script src="../js/jquery-3.3.1.js"></script>

	<!-- INCLUDE Jquery MASK for Inputs Fields -->
	<script src="../js/jquery.mask.min.js"></script>

	<!-- INCLUDE ECharts -->
	<script src="../js/echarts.min.js"></script>
	<script src="../js/echarts.common.min.js"></script>
	<script src="../js/echarts-stat/dist/ecStat.js"></script>

	<!-- INCLUDE Table Pagination DataTable -->
	<script src="../js/datatable/datatables.min.js"></script>

	<!-- INCLUDE Balloon Style for Tooltips -->
	<link rel="stylesheet" href="../css/balloon.css">

	<!-- INCLUDE JQuery UI Lib -->
	<script src="../js/jquery-ui.min.js"></script>

	<!-- INCLUDE JQuery UI CSS -->
	<link rel="stylesheet" href="../css/jquery-ui.min.css">
	
	<!-- INCLUDE BOOTSTRAP confirma -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> -->
	<script src="../js/bootstrap.min.js"></script>
	
	<!-- bootbox code -->
	<script src="../js/bootbox.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	<style>

		html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
		.editRemoveButton{
			height: 28px;
			margin: 0px;
		}
		.editRemoveIcon{
			vertical-align: top;
		}
		.dropdown-menu li {
			cursor: pointer;
		}
		.titleConsulta{
		    color: black;
		}
		.titleConsulta:hover{
		    opacity: 0.7;
		}
		/* tabela de consultas */
		#customers {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#customers td, #customers th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		#customers tr:nth-child(even){background-color: #f2f2f2;}

		#customers tr:hover {background-color: #ddd;}

		#customers th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #4CAF50;
			color: white;
		}

	</style>

</head>

<body class="w3-light-grey">

	<!-- Top container -->
	<div class="w3-bar w3-top w3-green w3-large" style="z-index:4">
	<button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey"  onclick="w3_open();" id="sideMenuCollapseButton"><i class="fa fa-bars"></i>  Menu</button>
	<a href="includes/exit.php" class="w3-bar-item w3-right w3-button"><i class="fa fa-sign-in"></i></a>
	<a href="#" id="bootbox" class="w3-bar-item w3-right w3-button optionR"><i class="fa fa-wrench"></i></a>
	<a href="#" class="w3-bar-item w3-right "><i class="load_top"></i></a>
	</div>


<!-- Sidebar/menu -->

<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar">
	<br>
	<div class="w3-container w3-row">
		<!-- SISPED logo -->
		<div class="w3-col s4">
			<img src="../images/sisped-logo.png" style="height:130px; margin-top:10px;">
		</div>
	</div>

	<div class="w3-container">
		<h5>IFSULDEMINAS</h5>
	</div>

	<!-- Menu/OPTIONS -->
	<div class="w3-bar-block">
		<a onclick="openPanel('listarTabMenu','PainelListar');" href="#" class="w3-bar-item w3-button w3-padding w3-red">
			<i class="fa fa-stethoscope fa-fw"></i> Consultas
		</a>
		<a href="adicionar-crianca.php" class="w3-bar-item w3-button w3-padding">
			<i class="fa fa-child"></i> Adicionar Criança
		</a>
		<a href="includes/exit.php" class="w3-bar-item w3-button w3-padding">
			<i class="fa fa-sign-out fa-fw"></i>Sair
		</a>
		<br><br>
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

	  	<div class="w3-row">
			<a href="javascript:void(0)" onclick="openPanel('listarTabMenu','PainelListar');">
			<div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red titleConsulta" id="listarTabMenu" data-balloon-length="medium" data-balloon="Para retornar à Listagem de Crianças, basta clicar aqui!" data-balloon-pos="up-left"><i class="fa fa-list"></i> Listar</div>
			</a>

			<a href="javascript:void(0)" onclick="">
			<div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding titleConsulta"  id="editarTabMenu"><i class="fa fa-pencil"></i> Editar Criança</div>
			</a>

			<a href="javascript:void(0)" onclick="">
			<div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding titleConsulta" id="analiseTabMenu"><i class="fa fa-user-md"></i> Análise</div>
			</a>
	  	</div>

	  <!-- Painel Listar -->
	  <div id="PainelListar" class="w3-container contentPanel w3-animate-opacity w3-card-4">
		<h2>Crianças</h2>
		<div id="t">
		<?php
		include("includes/dbconnection.php");

		$sql = "SELECT * FROM dadoscrianca where true";
		$result = $conn->query($sql);
			echo "<table width='100%' class='w3-table-all w3-card w3-hoverable' id='childrenTable'>\n";
			echo "
			<thead>
				<tr class='w3-pale-red'>
					<th>Criança</th>
					<th class='w3-center'>Nascimento</th>
					<th class='w3-center'>Prematuro (dias)</th>
					<th class='w3-center'>Análise</th>
					<th class='w3-center'>Editar</th>
					<th class='w3-center'>Consulta</th>
					<th class='w3-center'>Apagar</th>
				</tr>
			</thead>
		        <tbody>
			";
			while ($dados = $result->fetch_assoc()) {
				$var = $dados['idcrian'].",'".str_replace("\t", "%20", $dados['nome'])."','".$dados['sexo']."','".$dados['nascimento']."',".$dados['prematuro'].",".$dados['diasPrematuro'];
				echo "
					 <tr class='item'>
						 <td>";?> <b> <?php echo "".$dados['nome']."</b></td>\n";
				echo "\t\t\t\t\t\t\t<td class='w3-center'>".$dados['nascimento']."</td>\n";
				echo "\t\t\t\t\t\t\t<td class='w3-center'>".$dados['diasPrematuro']."</td>\n";
				echo "\t\t\t\t\t\t\t<td class='w3-center'>";?> <a onclick="setTimeout(function(){ nextChart('../../csv/Weight-for-age/Z-scores_boys/5_years.csv', <?php echo $dados['idcrian'] ?>, 'm','peso'); document.getElementById('NCrianca').innerHTML= '<?php echo $dados['nome'] ?>';  }, 300);gerarTable();sexo('<?php echo $dados['sexo'] ?>');openPanel('analiseTabMenu','PainelAnalise');" class='w3-button w3-hover-aqua w3-light-blue w3-round editRemoveButton'><i class='fa fa-user-md editRemoveIcon'></i><?php echo"</a></td>\n";
				echo "\t\t\t\t\t\t\t<td class='w3-center'>";?> <a onclick="update( <?php echo $var;  ?> ),openPanel('editarTabMenu','PainelEditar');" class='w3-button w3-hover-sand w3-khaki w3-round editRemoveButton'><i class='fa fa-pencil editRemoveIcon'></i><?php echo"</a></td>\n";
				echo "\t\t\t\t\t\t\t<td class='w3-center'>";?> <a onclick="modal( <?php echo $dados['idcrian'] ?> )" class='w3-button w3-hover-sand w3-khaki w3-round editRemoveButton'><i class='fa fa-archive editRemoveIcon'></i><?php echo "</a> </td>\n";
				echo "\t\t\t\t\t\t\t<td class='w3-center'>";?> <a onclick="del( <?php echo $dados['idcrian'] ?> )" class='w3-button w3-pale-red w3-hover-sand w3-red w3-round editRemoveButton'><i class='fa fa-trash-o editRemoveIcon'></i></a></td><?php echo"
					 </tr>\n
				";
			}
			echo "</tbody>\n";
			echo "\t\t\t</table>\n";
		?>
		</div>
	  </div>

	   <!-- END of Painel Listar -->

	<div id="PainelEditar" class="w3-container contentPanel w3-card-4 w3-animate-opacity" style="display:none">

	<h2>Editar Criança</h2>

	<form class="w3-container" style=" background-color:#fff;" action="acoes/updateChildren.php" method="post">
		<br>
		<div class="w3-row-padding">
			<input type="hidden" name = "id" id="id">
			<div class="w3-half">
					<label class="w3-text-red"><b>Nome: </b></label>
					<input id="nome" name="nome" class="w3-input w3-border w3-border-blue-gray" type="text" required>
			</div>
			<div class="w3-half">
				<label class="w3-text-red"><b>Sexo: </b></label>
					<select id="sexo" class="w3-select w3-border w3-border-blue-gray" name="option" required>
					<option value="" disabled selected>Escolha..</option>
					<option value="1">Menino</option>
					<option value="2">Menina</option>
					</select>
			</div>
		</div>
		<br>
		<div class="w3-row-padding">
			<div  class="w3-col" style="width:150px">
				<label class="w3-text-red"><b>Nascimento: </b></label>
				<input id="nascimento" name="nascimento" class="w3-input w3-border w3-border-blue-gray campoData" type="text" required>
			</div>

			<div class="w3-col" style="width:150px">
				<br>
				<label for="prematuro">Prematuro</label>
				<input id="prematuro" type="checkbox" class="myCheckBox w3-bottombar w3-bottom" style="top:100px;" name="prematuro" onclick="habilitar();">

			</div>

			<div class="w3-col" style="width:160px">
				<label class="w3-text-red"><b>Dias (se prematuro): </b></label>
				<input id="dias" name="dias" class="w3-input w3-border w3-border-blue-gray" type="number" name="dias" min="1" disabled>
			</div>
		</div>

		<br>
		<br>

		<div class="w3-center">
			<button class="w3-btn w3-border w3-border-red w3-round w3-pale-red"><b>Confirma</b></button>
		</div>

		<br>

	</form>

</div>
<!-- END of Painel Editar -->

	<!-- Painel Analise -->
	<div id="PDF">
		<link rel="stylesheet" href="../css/options_horizontal.css">
		<div id="PainelAnalise" class="w3-container contentPanel w3-card-4 w3-animate-opacity" style="display:none">

			<div id="topo">
				<h2 id="NCrianca"></h2>

				<nav class="navbar navbar-default" id="masculino">
					<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" id="referencesR" href="#">Bertapelli</a>
					</div>
						<ul class="nav navbar-nav">
							<li class="dropdown who" style="display: none;">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Peso por Idade
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li class="dropdown-header">ZScores</li>
									<li><a onclick="gerarCall('../../csv/Weight-for-age/Z-scores_boys/5_years.csv','m','peso')">5 years</a></li>
									<li><a onclick="gerarCall('../../csv/Weight-for-age/Z-scores_boys/13_week.csv','w','peso')">13 week</a></li>
									<li class="divider"></li>
									<li class="dropdown-header">Percentiles</li>
									<li><a onclick="gerarCall('../../csv/Weight-for-age/percentiles_boys/5_years.csv','m','peso')">5 years</a></li>
									<li><a onclick="gerarCall('../../csv/Weight-for-age/percentiles_boys/13_weeks.csv','w','peso')">13 week</a></li>
								</ul>
							</li>

							<li class="dropdown who" style="display: none;">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Peso por Comprimento/Altura <!-- requer atenção -->
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li class="dropdown-header">ZScores</li>
								<li><a onclick="gerarCall('../../csv/Weight-for-length-height/Z-scores_boys/2_years.csv','y3','peso')">2 years</a></li>
								<li><a onclick="gerarCall('../../csv/Weight-for-length-height/Z-scores_boys/2-5_years.csv','y4','peso')">2-5 years</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Percentiles</li>
								<li><a onclick="gerarCall('../../csv/Weight-for-length-height/percentiles_boys/2_years.csv','y3','peso')">2 years</a></li>
								<li><a onclick="gerarCall('../../csv/Weight-for-length-height/percentiles_boys/2-5_years.csv','y4','peso')">2-5 years</a></li>
								</ul>
							</li>

							<li class="dropdown  who" style="display: none;">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Circunferência da cabeça por idade
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li class="dropdown-header">ZScores</li>
								<li><a onclick="gerarCall('../../csv/Head-circumference-for-age/Zscores-boys/5_years.csv','y','perimetroCefalico')">5 years</a></li>
								<li><a onclick="gerarCall('../../csv/Head-circumference-for-age/Zscores-boys/13_weeks.csv','w','perimetroCefalico')">13 week</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Percentiles</li>
								<li><a onclick="gerarCall('../../csv/Head-circumference-for-age/percentiles-boys/5_years.csv','y','perimetroCefalico')">5 years</a></li>
								<li><a onclick="gerarCall('../../csv/Head-circumference-for-age/percentiles-boys/13_weeks.csv','w','perimetroCefalico')">13 week</a></li>
								</ul>
							</li>

							<li class="dropdown who" style="display: none;">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">IMC por Idade <!-- requer função especifica -->
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li class="dropdown-header">ZScores</li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/Zscores-boys/2-5_years.csv','y2-5','bmi')">2-5 years</a></li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/Zscores-boys/2_years.csv','y2','bmi')">2 years</a></li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/Zscores-boys/13_weeks.csv','w2','bmi')">13 week</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Percentiles</li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/percentiles-boys/2-5_years.csv','y2-5','bmi')">2-5 years</a></li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/percentiles-boys/2_years.csv','y2','bmi')">2 years</a></li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/percentiles-boys/13_weeks.csv','w2','bmi')">13 week</a></li>
								</ul>
							</li>

							<li class="dropdown bertapelli">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Estatura por Idade <!-- requer atenção -->
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li class="dropdown-header">Percentiles</li>
									<li><a onclick="gerarCall('../../csv/Bertapelli/estatura/3-20_years.csv','y20', 'altura')">3-20 Years</a></li>
									<li><a onclick="gerarCall('../../csv/Bertapelli/estatura/0-36_month.csv','m', 'altura')">0-36 Month</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>

				<nav class="navbar navbar-default" id="feminino">
					<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" id="referencesRR" href="#">Bertapelli</a>
					</div>
						<ul class="nav navbar-nav">
							<li class="dropdown who" style="display: none;">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Peso por Idade
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li class="dropdown-header">ZScores</li>
									<li><a onclick="gerarCall('../../csv/Weight-for-age/Z-scores_girls/5_years.csv','m','peso')">5 years</a></li>
									<li><a onclick="gerarCall('../../csv/Weight-for-age/Z-scores_girls/13_week.csv','w','peso')">13 week</a></li>
									<li class="divider"></li>
									<li class="dropdown-header">Percentiles</li>
									<li><a onclick="gerarCall('../../csv/Weight-for-age/percentiles_girls/5_years.csv','m','peso')">5 years</a></li>
									<li><a onclick="gerarCall('../../csv/Weight-for-age/percentiles_girls/13_weeks.csv','w','peso')">13 week</a></li>
								</ul>
							</li>

							<li class="dropdown who" style="display: none;">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Peso por Comprimento/Altura
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li class="dropdown-header">ZScores</li>
								<li><a onclick="gerarCall('../../csv/Weight-for-length-height/Z-scores_girls/2_years.csv','y3','peso')">2 years</a></li>
								<li><a onclick="gerarCall('../../csv/Weight-for-length-height/Z-scores_girls/2-5_years.csv','y4','peso')">2-5 years</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Percentiles</li>
								<li><a onclick="gerarCall('../../csv/Weight-for-length-height/percentiles_girls/2_years.csv','y3','peso')">2 years</a></li>
								<li><a onclick="gerarCall('../../csv/Weight-for-length-height/percentiles_girls/2-5_years.csv','y4','peso')">2-5 years</a></li>
								</ul>
							</li>

							<li class="dropdown  who" style="display: none;">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Circunferência da cabeça por idade
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li class="dropdown-header">ZScores</li>
								<li><a onclick="gerarCall('../../csv/Head-circumference-for-age/Zscores-girls/5_years.csv','m','perimetroCefalico')">5 years</a></li>
								<li><a onclick="gerarCall('../../csv/Head-circumference-for-age/Zscores-girls/13_weeks.csv','w','perimetroCefalico')">13 week</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Percentiles</li>
								<li><a onclick="gerarCall('../../csv/Head-circumference-for-age/percentiles-girls/5_years.csv','m','perimetroCefalico')">5 years</a></li>
								<li><a onclick="gerarCall('../../csv/Head-circumference-for-age/percentiles-girls/13_weeks.csv','w','perimetroCefalico')">13 week</a></li>
								</ul>
							</li>

							<li class="dropdown who" style="display: none;">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">IMC por Idade
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li class="dropdown-header">ZScores</li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/Zscores-girls/2-5_years.csv','y2-5','bmi')">2-5 years</a></li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/Zscores-girls/2_years.csv','y2','bmi')">2 years</a></li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/Zscores-girls/13_weeks.csv','w2','bmi')">13 week</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Percentiles</li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/percentiles-girls/2-5_years.csv','y2-5','bmi')">2-5 years</a></li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/percentiles-girls/2_years.csv','y2','bmi')">2 years</a></li>
								<li><a onclick="gerarCall('../../csv/BMI-for-age/percentiles-girls/13_weeks.csv','w2','bmi')">13 week</a></li>
								</ul>
							</li>

							<li class="dropdown bertapelli">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Estatura por Idade
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li class="dropdown-header">Percentiles</li>
									<li><a onclick="gerarCall('../../csv/Bertapelli/estatura/3-20_years.csv','y20', 'altura')">3-20 Years</a></li>
									<li><a onclick="gerarCall('../../csv/Bertapelli/estatura/0-36_month.csv','m', 'altura')">0-36 Month</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>

			</div>

			<script>
				document.getElementById("referencesRR").innerHTML = "WHO";
				document.getElementById("referencesR").innerHTML = "WHO";
				$('.who').show();
				$('.bertapelli').hide();
			</script>

			<!-- END of Painel Analise -->

			<div class="w3-container">
				<!-- responsividade requer atenção -->
				<div style="height: 700px; max-width: 100%; min-width: 200px; ">
	            <div id="container" style="height: 100%;"></div>
	     	</div>

		 </div>

		<br>
		
		<div id="teste"></div>

		<h3>Consultas</h3>
		<div class="cc" style="overflow: auto;"></div>

	</div>

 	<!-- Footer -->
	<footer class="w3-container w3-padding-16 w3-center w3-light-grey">
		<p ><img src="../images/ifsuldeminas.png" height="40" /></p>
	</footer>

	</div>
</div>


<!-- End page content -->

<!-- MODAL ADICIONAR CONSULTA -->
<div id="modalConsulta" class="w3-modal">
	<div class="w3-modal-content w3-card-4">
	  <header class="w3-container w3-green">
		<h2></h2>
	  </header>

	  <div class="w3-container">
			<div class="w3-container">
				<h2>Adicionar Consulta</h2>
					<form id="form" class="w3-container" style="background-color:#fff;" action="" method="post">
						<div class="w3-row-padding">
							<div class="w3-row-padding">
							<input type="hidden" name='id' id="idem">
								<div class="w3-half">
									<label class="w3-text-red"><b>Peso: </b></label>
									<input class="w3-input w3-border w3-border-blue-gray"  autocomplete="off" type="text" pattern="[0-9.%]{1,}"  name="peso" placeholder="coloque o peso da criança em Kg..." required>
								</div>
								<div class="w3-half">
									<label class="w3-text-red"><b>Altura: </b></label>
									<input class="w3-input w3-border w3-border-blue-gray" autocomplete="off" type="text" name="altura" pattern="[0-9.%]{1,}" placeholder="coloque a altura da criança em cm..." required>
								</div>
							</div>
							<br>
							<div class="w3-row-padding">
								<div class="w3-half">
									<label class="w3-text-red"><b>Perimetro Cefalico: </b></label>
									<input class="w3-input w3-border w3-border-blue-gray" type="text" autocomplete="off" pattern="[0-9.%]{1,}" name="perCefalico" placeholder="perimetro cefalico em cm..." required>
								</div>
								<div class="w3-half">
									<label class="w3-text-red"><b>Observação: </b></label>
									<input class="w3-input w3-border w3-border-blue-gray" type="text" autocomplete="off" name="obs" maxlength="255" placeholder="coloque uma observação da consulta...">
								</div>
							</div>
							<br>
							<div class="w3-row-padding">
								<div  class="w3-col" style="width:150px; float: right;;">
									<label class="w3-text-red"><b>Data Consulta: </b></label>
									<input class="w3-input w3-border w3-border-blue-gray campoData"  type="text" name="dataConsulta" required> <!-- type = date -->
								</div>
							</div>
						</div>
						<br>
						<div class="w3-center">
							<div onclick="$('#modalConsulta').hide(); zerar();" class="w3-btn w3-border w3-border-red w3-round w3-pale-red"><b>Cancelar</b></div>
							<button class="w3-btn w3-border w3-border-green w3-round w3-pale-green"><b>Adicionar</b></button>
							<p></p>
						</div>
					</form>
	  		</div>
		</div>
	</div>
</div>
    <script type="text/javascript">
        jQuery(document).ready(function(){
	        jQuery('#form').submit(function(){
		        var dados = jQuery( this ).serialize();

		        jQuery.ajax({
			        type: "POST",
			        url: "acoes/queryChildrenInsertion.php",
			        data: dados,
			        success: function(data)
			        {
				        console.log("Adicionado...");
				        $('#modalConsulta').hide();
				        $('#form input').val("");
			        }
		        });
		        
		        return false;
	        });
        });
    </script>    

<div id="modalUp" class="w3-modal">
	<div class="w3-modal-content w3-card-4">
		<header class="w3-container w3-green">
			<h2></h2>
		</header>
		<div class="w3-container">
			<div class="w3-container">
				<h2>Adicionar Consulta</h2>
				<form id="ajax_form" class="w3-container" style="background-color:#fff;" method="post" action="">
					<div class="w3-row-padding">
						<div class="w3-row-padding">
						<input type="hidden" name='id' id="ide">
							<div class="w3-half">
								<label class="w3-text-red"><b>Peso: </b></label>
								<input class="w3-input w3-border w3-border-blue-gray"  id="ConPeso" autocomplete="off" type="text" pattern="[0-9.%]{1,}"  name="peso" placeholder="coloque o peso da criança em Kg..." required>
							</div>
							<div class="w3-half">
								<label class="w3-text-red"><b>Altura: </b></label>
								<input class="w3-input w3-border w3-border-blue-gray" id="ConAltura" autocomplete="off" type="text" name="altura" pattern="[0-9.%]{1,}" placeholder="coloque a altura da criança em cm..." required>
							</div>
						</div>
						<br>
						<div class="w3-row-padding">
							<div class="w3-half">
								<label class="w3-text-red"><b>Perimetro Cefalico: </b></label>
								<input class="w3-input w3-border w3-border-blue-gray" id="ConPer" type="text" autocomplete="off" pattern="[0-9.%]{1,}" name="perCefalico" placeholder="perimetro cefalico em cm..." required>
							</div>
							<div class="w3-half">
								<label class="w3-text-red"><b>Observação: </b></label>
								<input class="w3-input w3-border w3-border-blue-gray" type="text" autocomplete="off" id="ConObs" name="obs" maxlength="255" placeholder="coloque uma observação da consulta...">
							</div>
						</div>
						<br>
						<div class="w3-row-padding">
							<div  class="w3-col" style="width:150px; float: right;;">
								<label class="w3-text-red"><b>Data Consulta: </b></label>
								<input class="w3-input w3-border w3-border-blue-gray campoData"  id="ConData" type="text" name="dataConsulta" required> <!-- type = date -->
							</div>
						</div>
					</div>
					<br>
					<div class="w3-center">
						<div onclick="$('#modalUp').hide();" class="w3-btn w3-border w3-border-red w3-round w3-pale-red"><b>Cancelar</b></div>
						<div onclick="$('#modalUp').hide(); delCon();" class="w3-btn w3-border w3-border-red w3-round w3-pale-red"><b>Excluir</b></div>
						<button class="w3-btn w3-border w3-border-green w3-round w3-pale-green" ><b class="loadModal">Atualizar</b></button>
						<p></p>
					</div>
				</form>
			</div>
		</div>
	  <footer class="w3-container w3-green">
	  	<p></p>
	  </footer>
	</div>
</div>

    <input id="Bknome" type="hidden"></input>
    <input id="Bkpesq" type="hidden"></input>
    <input id="Bktime" type="hidden"></input>
    <input id="Bkid" type="hidden"></input>
 
    <script type="text/javascript">
        function delCon(){
            bootbox.confirm({
                message: "Excluir esta consulta?",
                buttons: {
                        confirm: {
                                label: 'SIM',
                                className: 'btn-success'
                        },
                        cancel: {
                                label: 'NÃO',
                                className: 'btn-danger'
                        }
                },
                callback: function (result) {
                        if (result) {
                            excluirConsulta();
                        }
                }
            });
        }
        
        jQuery(document).ready(function(){
	        jQuery('#ajax_form').submit(function(){
		        var dados = jQuery( this ).serialize();

		        jQuery.ajax({
			        type: "POST",
			        url: "acoes/queryUpdate.php",
			        data: dados,
			        success: function( data )
			        {
				        gerarTable();
				        chartUpdate();
				        $('#modalUp').hide();  
			        }
		        });
		        
		        return false;
	        });
        });
    </script>

	<!-- bootbox code < não retirar > -->
	<script src="../js/bootbox.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	<script>
		function excluirConsulta(){
			var id = document.getElementById('ide').value;
			$.getJSON("acoes/queryDelete.php",{id : id}, function(data){
				//location.reload();
				gerarTable();

			})
		};

		/* REFERENCE: https://datatables.net/examples/basic_init/dom.html */
		$(document).ready(function(){

		//Cria a tabela usando DATA_TABLE
		$('#childrenTable').DataTable( {

			"language": {
				"search": "",
				"paginate": {
				"previous": "Anterior",
				"next": "Próximo"
				}
			},
			responsive: true,

			"dom": '<"w3-input"f><t><"page-navigation"p>',

			"columnDefs": [
				{
					/*"targets": [ 1 ],
					"visible": false,*/
					"searchable": true
				},
				/*
				{
					"targets": [ 3 ],
					"visible": false
				},*/

			]
		} );
		//Formata campo de busca da tabela
		$('#childrenTable_filter input').addClass('w3-input w3-border-top w3-border-bottom w3-round-small w3-border-green');
		$('#childrenTable_filter input').attr('placeholder','Procurar..');

		//Formata campos de 'DATA' e 'PREMATURO' da aba 'Editar'
		$('.campoData').datepicker({dateFormat: 'dd/mm/yyyy'});
		$('.campoData').mask("99/99/9999", {placeholder:"__/__/____"});
		$( ".myCheckBox" ).checkboxradio();
		});

		$(document).on("click", ".optionR", function(e){
			bootbox.prompt({
					title: "Escolha a Referência:",
					inputType: 'select',
					inputOptions: [
							{
						text: 'Escolha uma organização',
						value: '',
					},
							{
									text: 'Bertapelli',
									value: 1,
							},
							{
						text: 'WHO',
						value: 2,
					}
					],
					callback: function (result) {
							references(result);
					}
			});
		});

		function references(aux){
			console.log(aux);
			if (aux == 1){
				document.getElementById("referencesRR").innerHTML = "Bertapelli";
					$('.who').hide();
					$('.bertapelli').show();
			}else if (aux == 2){
					document.getElementById("referencesRR").innerHTML = "WHO";
					$('.bertapelli').hide();
					$('.who').show();
				}

			if (aux == 1){
				document.getElementById("referencesR").innerHTML = "Bertapelli";
					$('.who').hide();
					$('.bertapelli').show();
			}else if (aux == 2){
					document.getElementById("referencesR").innerHTML = "WHO";
					$('.bertapelli').hide();
					$('.who').show();
				}
			}
			
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
        };

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }




	</script>

	<!-- END of DataTable -->

	</body>
</html>
