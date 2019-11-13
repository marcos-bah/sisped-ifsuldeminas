<!DOCTYPE html>
<html>
<head>
	<title>SISPED - Sistema de Análise de Dados Pediátricos</title>
	<link rel="icon" href="../images/sisped.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/w3.css">
</head>

<body>
	<div class="w3-container">
	  <div style="display: block;" class="w3-modal">
		<div class="w3-modal-content w3-card-4  w3-animate-zoom" style="max-width:600px">

		  <div class="w3-center"><br>
			<img src="../image/sisped-logo.png" alt="SISPED" style="height: 130px;" class=" w3-margin-top">
		  </div>

		  <form class="w3-container" action="includes/initLogin.php" method="post">
			<div class="w3-section">
			  <label><b>Usuário</b></label>
			  <input class="w3-input w3-border w3-margin-bottom" autocomplete="off" type="text" placeholder="Digite o nome de usuário" name="login">
			  <label><b>Senha</b></label>
			  <input class="w3-input w3-border" type="password" placeholder="Digite sua senha" name="senha" autocomplete="off">
			  <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
			</div>
		  </form>
		</div>
	  </div>
	</div>
	<div class="w3-container w3-bottom w3-center" style="bottom: 15px;">
		 <img src="../image/ifsuldeminas.png" style="width: 250px" alt="Logo IFSULDEMINAS"/>
	</div>
</body>
</html>
