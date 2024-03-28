<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mom compte</title>
	<link rel="stylesheet" type="text/css" href="../css/styleSignUp.css">
	<link rel="icon" type="image/x-icon" href="../image/logo.png">
</head>
<body>

	<?php session_start(); ?>
	<?php include("head.php"); ?>

	<div class="body">
		<div id="partie-One">
			<div id="partie-One-One">
				<?php   //Scipt pour afficher le nombre total de message
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

					$resultat = $cnn -> prepare('SELECT nomMemb, idMemb, prenomMemb, typeMemb, dateIns
												 FROM membre
												 WHERE idMemb = :idmembre');
					$resultat->bindParam(':idmembre', $_SESSION["Utilisateur"], PDO::PARAM_STR);

					$resultat->execute();

					while ($row = $resultat -> fetch())
					{?>
						<p> <?php echo  "Nom : " .$row['nomMemb'];?> </p>
							<div id="partie-One">
								<form method="POST">
									<div id="partie-One-One">
										<input id="formTexte" type="text" name="nom" placeholder="Entrer votre nom" size="50"><br>
									</div> 
									<div id="partie-One-Two">
										<button id="formPass" type="submit">Envoyer</button>
									</div>	
								</form>
							</div>
						</div>
						<?php
						if (isset($_POST['nom'])) { 
							
							
							$requete = $cnn->prepare('UPDATE membre SET nomMemb = :newMemb WHERE idMemb = :Utilisateur');
							echo $newMemb;
							echo $_SESSION['Utilisateur'];
							$requete->bindParam(':newMemb', $_POST['nom'], PDO::PARAM_STR);
							$requete->bindParam(':Utilisateur', $_SESSION['Utilisateur'], PDO::PARAM_STR);
							echo $requete;
							$requete->execute();
							header("refresh: 1");

						} 
						?>

						<p> <?php echo  "Prénom : " .$row['prenomMemb'];?> </p>
							<div id="partie-One">
								<form method="POST">
									<div id="partie-One-One">
										<input id="formTexte" type="text" name="prenom" placeholder="Entrer votre prénom" size="50"><br>
									</div> 
									<div id="partie-One-Two">
										<button id="formPass" type="submit" name="submit3">Envoyer</button>
									</div>
								</form>
							</div>
						</div>
						<?php
						if (isset($_POST['submit3'])) { 
							$cnn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
							if ($cnn->connect_error) {
								die("La connexion à la base de données a échoué : " . $cnn->connect_error);
							}

							$newPrMemb = $_POST['prenom'];
							$requete = $cnn->prepare('UPDATE membre SET prenomMemb = :newPrMemb WHERE idMemb = :Utilisateur');
							if (!$requete) {
       							die("La préparation de la requête a échoué : " . $cnn->errorInfo()[2]);
    						}
							echo $newMemb;
							echo $_SESSION['Utilisateur'];
							$requete->bindParam(':newMemb', $newMemb, PDO::PARAM_STR);
							$requete->bindParam(':Utilisateur', $_SESSION['Utilisateur'], PDO::PARAM_STR);
							echo $requete;
							$requete->execute();
							header("refresh: 1");

						} 
						?>

						<p> <?php echo  "Mail : " . $row['idMemb'];?> </p>
							<div id="partie-One">
								<form method="POST">
									<div id="partie-One-One">
										<input id="formTexte" type="text" name="mail" placeholder="Entrer votre mail" size="50"><br>
									</div> 
									<div id="partie-One-Two">
										<button id="formPass" type="submit">Envoyer</button>
									</div>	
								</form>
							</div>
						<p> <?php echo  "Date d'inscription : " .$row['dateIns'];?> </p>
						<?php
							if($row['typeMemb']==1)
							{?>
								<p> <?php echo  "niveau du membre : paysan "?> </p>
							<?php
							}
							elseif($row['typeMemb']==2)
							{?>
								<p> <?php echo  "niveau du membre : modo "?> </p>
							<?php
							}
							elseif($row['typeMemb']==3)
							{?>
								<p> <?php echo  "Niveau du membre : admin "?> </p>
							<?php
							}
							}
						?>
						<p> Mot de passe :  <a href="changePassword.php"> Changer son mot de passe</a> </p>
						</div>



			</div> 			
		</div>
	</div>

</body>
</html>