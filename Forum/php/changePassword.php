<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Page d'accueil</title>
	<link rel="stylesheet" type="text/css" href="../css/styleSignUp.css">
	<link rel="icon" type="image/x-icon" href="../image/logo.png">
</head>
<body>

	<?php session_start(); ?>
	<?php include("head.php"); ?>


	<div class="body">
		<div id="partie-One">
			<form method="POST">
				<div id="partie-One-One">
					<input id="formTexte" type="text" name="mail" placeholder="Entrer votre e-mail" size="50"><br>
					<input id="formTexte" type="password" name="mdp" placeholder="Entrer votre mot de passe" size="30"><br>
					<input id="formTexte" type="password" name="chose" placeholder="Entrer votre chose préféré" size="30"><br>
				</div> 
				<div id="partie-One-Two">
					<button id="formPass" type="submit">Envoyer</button>
				</div>				
			</form>
		</div>
	</div>


    <?php

		if(isset($_POST["mail"]) && isset($_POST["mdp"]) && isset($_POST["chose"])){
			$host ="localhost";    //Nom de l'hote
			$bdd = "Forum";       //nom de la base de données
			$user = "root";
			$password = "root";

			//On essaie de se connecter
			try {    //Connexion à la base et au serveur
				$cnn = new PDO("mysql:host=$host;dbname=$bdd;charset=utf8",$user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			}
			// En cas d'erreur, on affiche un message et arrete tout
			catch(PDOExeption $e) {
				echo "Erreur : " . $e->getMessage();
			}

			$text = $_POST["mdp"];
			$key = $_POST["chose"];
			$decrypt = true; // mettre à true pour déchiffrer

			$keyLength = strlen($key);
			$textLength = strlen($text);
			$crypter = "";
			for ($i = 0; $i < $textLength; $i++) {
			    $keyIndex = $i % $keyLength;
			    $keyChar = $key[$keyIndex];
			    $textChar = $text[$i];
			    $keyOffset = ord(strtoupper($keyChar)) - 65;
			    $textOffset = ord(strtoupper($textChar)) - 65;
			    if ($decrypt) {
			        $offset = ($textOffset - $keyOffset + 26) % 26;
			    } else {
			        $offset = ($textOffset + $keyOffset) % 26;
			    }
			    $crypter .= chr($offset + 65);
			}
				$resultat = $cnn -> prepare('SELECT mdpMemb FROM membre WHERE idMemb = :email');
				$resultat->bindParam(':email', $_POST["mail"], PDO::PARAM_STR);
				$resultat->execute();
				
				$row = $resultat -> fetch();

				$resultat->closeCursor();


		    	if ($crypter == $row['mdpMemb']) { ?>
		    		

					<form method="POST">
						<div id="partie-One-One">
							<label>Vous pouvez changer votre mot de passe</label>
							<input id="formTexte" type="text" name="mail" placeholder="Entrer votre e-mail" size="50"><br>
							<input id="formTexte" type="password" name="newPass" placeholder="Saisir votre nouveau mot de passe" size="50"><br>
							<input id="formTexte" type="password" name="newPassword" placeholder="Vérifier votre mot de passe" size="50"><br>
							<input id="formTexte" type="password" name="chose" placeholder="Entrer votre chose préféré" size="30"><br>
						</div> 
						<div id="partie-One-Two">
							<button id="formPass" type="submit">Envoyer</button>
						</div>				
					</form>

					<?php


					$resultat = $cnn -> prepare('UPDATE membre SET mdpMemb = ":newMdp" WHERE idMemb = :email');

					$resultat>bindParam(':email', $_POST["mail"], PDO::PARAM_STR);



					$text = $_POST["newPassword"];
					$key = $_POST["chose"];
					$decrypt = false; // mettre à true pour déchiffrer

					$keyLength = strlen($key);
					$textLength = strlen($text);
					$crypter = "";
					for ($i = 0; $i < $textLength; $i++) {
					    $keyIndex = $i % $keyLength;
					    $keyChar = $key[$keyIndex];
					    $textChar = $text[$i];
					    $keyOffset = ord(strtoupper($keyChar)) - 65;
					    $textOffset = ord(strtoupper($textChar)) - 65;
					    if ($decrypt) {
					        $offset = ($textOffset - $keyOffset + 26) % 26;
					    } else {
					        $offset = ($textOffset + $keyOffset) % 26;
					    }
					    $crypter .= chr($offset + 65);
					}

					$resultat->bindParam(':newMdp', $crypter, PDO::PARAM_STR);



					$resultat->execute();

					$resultat->closeCursor();
					$cnn=null;
		    	}
		    }
		    
		?>


</body>
</html>