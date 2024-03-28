<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Page d'accueil</title>
	<link rel="stylesheet" type="text/css" href="../css/styleArticle.css">
	<link rel="icon" type="image/x-icon" href="../image/logo.png">
</head>
<body>

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
	?>


	<?php include("head.php"); ?>
	<?php session_start(); 
	$_SESSION["numeroArticle"] = $_GET['numArticle'];

	if ($_SESSION['isLogin'] == "yes") { 
		?>
		<div class="body">

			<?php

				if (isset($_GET['numArticle'])) {

					$resultat = $cnn -> prepare('SELECT article.idArt, titreArt
												 FROM article
												 JOIN membre ON article.idMemb = membre.idMemb
												 JOIN reponse ON article.idArt = reponse.idArt
												 WHERE article.idArt = :numArticle');
					$resultat->bindParam(':numArticle', $_GET['numArticle'], PDO::PARAM_INT);
					$resultat->execute();
					?>
					<div id="partie-One">

					<?php
					if ($row = $resultat -> fetch())
					{ ?>

						<div id="partie-One-One">
							<p id="titre"> <?php echo $row['titreArt'];?> <p>
						</div>		
						<div id="partie-One-Two">

						<?php
							$total = $cnn -> prepare('SELECT contenuArt, article.idArt , dateRep, article.idMemb, substring(prenomMemb, 1, 1) as test
								FROM article  
								JOIN membre ON article.idMemb = membre.idMemb
								JOIN reponse ON article.idArt = reponse.idArt
								WHERE article.idArt = :numArticle');

							$total->bindParam(':numArticle', $_GET['numArticle'], PDO::PARAM_INT);

							$total->execute();

							if ($ligne = $total -> fetch())
							{ ?>
								<div id="partie-One-Two-Two">
									<p class="avatar" > <?php echo $ligne['test']; ?></p>
									<p id="partie-One-Two-Two-One">
										<span>Par <span id="membreHierarchie"><?php echo $ligne['idMemb'];?></span></span> 
										<span><?php echo "Il y a : " . $ligne['dateRep'];?></span>
									</p>
								</div>

								<p id="rebrique">	
									<span id="description"><?php echo $ligne['contenuArt'];?></span> 
								</p>
								<div class="test"></div>
								<?php
						
								$conca = $cnn -> prepare('SELECT  contenuRep, dateRep, article.idMemb, titreArt, article.idArt, substring(prenomMemb, 1, 1) as test
						 									FROM article
															 INNER JOIN membre ON article.idMemb = membre.idMemb
															 INNER JOIN reponse ON article.idArt = reponse.idArt
															 WHERE article.idArt = :idArticle');

								$conca->bindParam(':idArticle', $ligne['idArt'], PDO::PARAM_INT);
								$conca->execute();
								while ($contenu = $conca -> fetch())
								{ ?>

									<div id="partie-One-Two-Two">
										<p class="avatar" > <?php echo $contenu['test']; ?></p>
										<p id="partie-One-Two-Two-One">
											<span>Par <span id="membreHierarchie"><?php echo $contenu['idMemb'];?></span></span> 
											<span><?php echo "Il y a : " . $contenu['dateRep'];?></span>
										</p>
									</div>

									<p id="rebrique">	
										<span id="description"><?php echo $contenu['contenuRep'];?></span> 
									</p>
									<div class="test"></div>


								<?php
								}
								$conca->closeCursor();

							}	
							$total->closeCursor();	
							?>	
								
						</div>		
						

						<?php
					}
				

					$resultat->closeCursor();
						
					?>
					</div>
					<div id="partie-One" class="reponse">
						<div id="partie-One-One">
							<p id="titre">Ecrivez votre poste</p>
						</div>
						<div id="partie-One-Two">
							<form method="POST" action="">
								<textarea rows="10" cols="99" name="Reponse" placeholder="Ecrivez votre poste ici."></textarea>
								<button id="formPass" type="submit">Envoyer</button>
							</form>
						</div>
					</div>
				<?php
				if(isset($_POST["Reponse"])) {
					$total = $cnn -> prepare('INSERT INTO reponse (idMemb, idArt, contenuRep) VALUES (:membreForum, :numArticle, :reponseForum)');

					$total->bindParam(':reponseForum', $_POST['Reponse'], PDO::PARAM_STR);
					$total->bindParam(':membreForum', $_SESSION["Utilisateur"], PDO::PARAM_STR);
					$total->bindParam(':numArticle', $_SESSION["numeroArticle"], PDO::PARAM_INT);

					$total->execute();	
					$total->closeCursor();	
					header("refresh: 1");			
				}
				} 
				$cnn=null;
	} 
	else {
			?>

		<div class="body">

			<?php

				if (isset($_GET['numArticle'])) {

					$resultat = $cnn -> prepare('SELECT article.idArt, titreArt
												 FROM article
												 JOIN membre ON article.idMemb = membre.idMemb
												 JOIN reponse ON article.idArt = reponse.idArt
												 WHERE article.idArt = :numArticle');
					$resultat->bindParam(':numArticle', $_GET['numArticle'], PDO::PARAM_INT);
					$resultat->execute();
					?>
					<div id="partie-One">

					<?php
					if ($row = $resultat -> fetch())
					{ ?>

						<div id="partie-One-One">
							<p id="titre"> <?php echo $row['titreArt'];?> <p>
						</div>		
						<div id="partie-One-Two">

						<?php
							$total = $cnn -> prepare('SELECT contenuArt, article.idArt , dateRep, reponse.idMemb
								FROM article  
								JOIN membre ON article.idMemb = membre.idMemb
								JOIN reponse ON article.idArt = reponse.idArt
								WHERE article.idArt = :numArticle');

							$total->bindParam(':numArticle', $_GET['numArticle'], PDO::PARAM_INT);

							$total->execute();

							if ($ligne = $total -> fetch())
							{ ?>
								<div id="partie-One-Two-Two">
									<img id="imageProfile" src="../image/imageProfile.png">
									<p id="partie-One-Two-Two-One">
										<span>Par <span id="membreHierarchie"><?php echo $ligne['idMemb'];?></span></span> 
										<span><?php echo "Il y a : " . $ligne['dateRep'];?></span>
									</p>
								</div>

								<p id="rebrique">	
									<span id="description"><?php echo $ligne['contenuArt'];?></span> 
								</p>
								<div class="test"></div>
								<?php
						
								$conca = $cnn -> prepare('SELECT  contenuRep, dateRep, article.idMemb, titreArt, article.idArt
						 									FROM article
															 INNER JOIN membre ON article.idMemb = membre.idMemb
															 INNER JOIN reponse ON article.idArt = reponse.idArt
															 WHERE article.idArt = :idArticle');

								$conca->bindParam(':idArticle', $ligne['idArt'], PDO::PARAM_INT);
								$conca->execute();
								while ($contenu = $conca -> fetch())
								{ ?>

									<div id="partie-One-Two-Two">
										<img id="imageProfile" src="../image/imageProfile.png">
										<p id="partie-One-Two-Two-One">
											<span>Par <span id="membreHierarchie"><?php echo $contenu['idMemb'];?></span></span> 
											<span><?php echo "Il y a : " . $contenu['dateRep'];?></span>
										</p>
									</div>

									<p id="rebrique">	
										<span id="description"><?php echo $contenu['contenuRep'];?></span> 
									</p>
									<div class="test"></div>


								<?php
								}
								$conca->closeCursor();

							}	
							$total->closeCursor();	
							?>	
								
						</div>		

						<?php
					}
				

					$resultat->closeCursor();
					$cnn=null;	
					?>
					</div>
				<?php
				}

	}
	?>




	<?php include("foot.php"); ?>
</body>
</html>




