<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SignUp</title>
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
					<input id="formTexte" type="text" name="nom" placeholder="Entrer votre nom" size="50"><br>
					<input id="formTexte" type="text" name="prenom" placeholder="Entrer votre prenom" size="50"><br>
					<input id="formTexte" type="email" name="mail" placeholder="Entrer votre e-mail" size="50"><br>
					<input id="formTexte" type="password" name="Password" placeholder="Entrer votre mot de passe" size="20"><br>
					<input id="formTexte" type="text" name="animal" placeholder="Entrer votre chose préféré" size="50"><br>
				</div> 
				<div id="partie-One-Two">
					<button id="formPass" type="submit">Envoyer</button>
				</div>	
			</form>
			<a href="changePassword.php">Changer son mot de passe</a>
		</div>
	</div>

    <?php 


    /**if (isset($_POST["mail"])) {

	    echo $_mail;
	    	$aleatoire = rand(111, 999);
    	echo "<p>Finissez de vous enregistrer.</p>";
	    echo "<p>Veuillez entrer le nombre affiché :" . $aleatoire . "</p>"

	         ?>
	        <form id="formulaire" method="GET">
				<div id="partie-Two">
					<input id="formTexte" type="password" name="nombreEnvoye" placeholder="Entrer le nombre que vous avez reçu" size="3"><br>
				</div> 
				<div id="partie-Two-One">
					<button id="formPass" type="submit">Envoyer</button>
				</div>	
			</form>
		<?php	
    }
    ?>

    <?php */
    	if (isset($_POST["mail"])) {
    		echo "Vous avez bien été enregistré";


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

			$resultat = $cnn -> prepare('INSERT INTO membre (idMemb, nomMemb, prenomMemb, mdpMemb, typeMemb) VALUES (:idMembre, :nom, :prenom, :mdpCode, :nombreType)');

			$resultat->bindParam(':idMembre', $_POST["mail"], PDO::PARAM_STR);
			$resultat->bindParam(':nom', $_POST["nom"], PDO::PARAM_STR);
			$resultat->bindParam(':prenom', $_POST["prenom"], PDO::PARAM_STR);
			$resultat->bindParam(':mdpCode', $crypter, PDO::PARAM_STR);

			$text = $_POST["Password"];
			$key = $_POST["animal"];
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




			$nombType = 1;
			$resultat->bindParam(':nombreType', $nombType, PDO::PARAM_INT);

			$resultat->execute();

			$resultat->closeCursor();
			$cnn=null;

    	}
    	?>


</body>
</html>