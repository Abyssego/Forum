<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/styleHead.css">
</head>
<body>
	<?php session_start(); 
	if ($_SESSION['isLogin'] == "yes") { 
		?>
		<div class="head">
			<ul>	
				<li id="nav"><img id="logo" src="../image/logo.png" alt="Forum BTS SIO"></li>
				<li id="nav"><a href="../index.php" id="normal">Accueil</a></li>
				<li><a href="profil.php" id="reste">Mon compte</a></li>	
			</ul>
		</div>
		<?php 
	} else {
		?>
		<div class="head">
			<ul>	
				<li id="nav"><img id="logo" src="../image/logo.png" alt="Forum BTS SIO"></li>
				<li id="nav"><a href="../index.php" id="normal">Accueil</a></li>
				<li><a href="signUp.php" id="reste">S'inscrire</a></li>	
				<li><a href="login.php" id="reste">Se connecter</a></li>
			</ul>		
		</div> 
	<?php
	}
	?>
</body>
</html>