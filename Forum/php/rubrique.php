<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rubrique</title>
	<link rel="stylesheet" type="text/css" href="../css/styleRubrique.css">
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
	$_SESSION["numeroRubrique"] = $_GET['numRubrique'];


	if ($_SESSION['isLogin'] == "yes") { 
		?>
		<div class="body">

			<?php

				if (isset($_GET['numRubrique'])) {

					$resultat = $cnn -> prepare('SELECT article.idArt, titreArt, rubrique.idRub, nomRub
												 FROM rubrique
												 JOIN article ON rubrique.idRub = article.idRub
												 WHERE rubrique.idRub = :numRubrique');
					$resultat->bindParam(':numRubrique', $_GET['numRubrique'], PDO::PARAM_INT);

					$resultat->execute();
					?>
					<div id="partie-One">

					<?php
					while ($row = $resultat -> fetch())
					{ ?>

						<div id="partie-One-One">
							<p id="titre"> <?php echo $row['nomRub'];?> <p>
						</div>		
						<div id="partie-One-Two">

						<?php
							$total = $cnn -> prepare('SELECT idArt FROM article WHERE idArt = "' . $row['idArt'] .'" ');

							$total->execute();

							while ($ligne = $total -> fetch())
							{ ?>

								<?php
						
								$conca = $cnn -> prepare('SELECT  contenuRep, dateRep, article.idMemb, rubrique.idRub, titreArt, article.idArt, COUNT(reponse.idRep), nomRub, descRub, substring(prenomMemb, 1, 1) as test
						 									FROM categorie
															 INNER JOIN rubrique ON categorie.idCat = rubrique.idCat
															 INNER JOIN article ON rubrique.idRub = article.idRub
															 INNER JOIN membre ON article.idMemb = membre.idMemb
															 INNER JOIN reponse ON membre.idMemb = reponse.idMemb
															 WHERE article.idArt = :idArticle');

								$conca->bindParam(':idArticle', $ligne['idArt'], PDO::PARAM_INT);
								$conca->execute();



								while ($contenu = $conca -> fetch())
								{ ?>	
									<img id="logo" src="../image/logo.png">
									<p id="rebrique">	
										<span id="sousTitre"><a href="article.php?numArticle=<?php echo $contenu['idArt'];?>"><?php echo $contenu['titreArt'];?></a></span>
									</p>

									<p id="partie-One-Two-One">
										<?php
										$nombreReponse = $cnn -> prepare('SELECT COUNT(reponse.idRep) + COUNT(DISTINCT article.idArt) as totalReponse
								 									 FROM article
																	 INNER JOIN reponse ON article.idArt = reponse.idArt
																	 WHERE article.idArt = :idArticleDeux');
										$nombreReponse->bindParam(':idArticleDeux', $ligne['idArt'], PDO::PARAM_INT);
										$nombreReponse->execute();

										if($afficheNombreReponse = $nombreReponse -> fetch()) { ?>
											<span id="nombreMessage"><?php echo $afficheNombreReponse['totalReponse'];?></span> <?php
										} 
										$nombreReponse->closeCursor();
										?>
										<span id="Message">messages</span>
									</p>

									<div id="partie-One-Two-Two">
										<p class="avatar" > <?php echo $contenu['test']; ?></p>
										<p id="partie-One-Two-Two-One">
											<span>Par <span id="membreHierarchie"><?php echo $contenu['idMemb'];?></span></span> 
											<span><?php echo "Il y a : " . $contenu['dateRep'];?></span>
										</p>
									</div>
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
								<textarea rows="5" cols="45" name="TitreEntrer" placeholder="Entrer le titre ici."></textarea>
								<textarea rows="10" cols="99" name="ArticleEntrer" placeholder="Ecrivez le contenu de votre question ici."></textarea>
								<button id="formPass" type="submit">Envoyer</button>
							</form>
						</div>
					</div>
				<?php
				if(isset($_POST["ArticleEntrer"])) {
					$total = $cnn -> prepare('INSERT INTO article (titreArt, contenuArt, idMemb, idRub) VALUES (:titreForum, :articleForum, :membreForum, :numRubrique)');

					$total->bindParam(':titreForum', $_POST['TitreEntrer'], PDO::PARAM_STR);
					$total->bindParam(':articleForum', $_POST['ArticleEntrer'], PDO::PARAM_STR);
					$total->bindParam(':membreForum', $_SESSION["Utilisateur"], PDO::PARAM_STR);
					$total->bindParam(':numRubrique', $_SESSION["numeroRubrique"], PDO::PARAM_INT);

					$total->execute();	
					$total->closeCursor();	
					header("refresh: 1");			
				}
				} 
				$cnn=null;
				
		} else {
			?>
			<div class="body">

				<?php

					if (isset($_GET['numRubrique'])) {

						$resultat = $cnn -> prepare('SELECT article.idArt, titreArt, rubrique.idRub, nomRub
													 FROM rubrique
													 JOIN article ON rubrique.idRub = article.idRub
													 WHERE rubrique.idRub = :numRubrique');
						$resultat->bindParam(':numRubrique', $_GET['numRubrique'], PDO::PARAM_INT);

						$resultat->execute();
						?>
						<div id="partie-One">

						<?php
						while ($row = $resultat -> fetch())
						{ ?>

							<div id="partie-One-One">
								<p id="titre"> <?php echo $row['nomRub'];?> <p>
							</div>		
							<div id="partie-One-Two">

							<?php
								$total = $cnn -> prepare('SELECT idArt FROM article WHERE idArt = "' . $row['idArt'] .'" ');

								$total->execute();

								while ($ligne = $total -> fetch())
								{ ?>

									<?php
							
									$conca = $cnn->prepare('SELECT contenuRep, dateRep, article.idMemb, rubrique.idRub, titreArt, article.idArt, COUNT(reponse.idRep), nomRub, descRub, substring(prenomMemb, 1, 1) as test
															FROM categorie
															INNER JOIN rubrique ON categorie.idCat = rubrique.idCat
															INNER JOIN article ON rubrique.idRub = article.idRub
															INNER JOIN membre ON article.idMemb = membre.idMemb
															INNER JOIN reponse ON membre.idMemb = reponse.idMemb
															WHERE article.idArt = :idArticle
															GROUP BY contenuRep, dateRep, article.idMemb, rubrique.idRub, titreArt, article.idArt, nomRub, descRub');


									$conca->bindParam(':idArticle', $ligne['idArt'], PDO::PARAM_INT);
									$conca->execute();



									while ($contenu = $conca -> fetch())
									{ ?>	
										<img id="logo" src="../image/logo.png">
										<p id="rebrique">	
											<span id="sousTitre"><a href="article.php?numArticle=<?php echo $contenu['idArt'];?>"><?php echo $contenu['titreArt'];?></a></span>
										</p>

										<p id="partie-One-Two-One">
											<?php
											$nombreReponse = $cnn -> prepare('SELECT COUNT(reponse.idRep) + COUNT(DISTINCT article.idArt) as totalReponse
									 									 FROM article
																		 INNER JOIN reponse ON article.idArt = reponse.idArt
																		 WHERE article.idArt = :idArticleDeux');
											$nombreReponse->bindParam(':idArticleDeux', $ligne['idArt'], PDO::PARAM_INT);
											$nombreReponse->execute();

											if($afficheNombreReponse = $nombreReponse -> fetch()) { ?>
												<span id="nombreMessage"><?php echo $afficheNombreReponse['totalReponse'];?></span> <?php
											} 
											$nombreReponse->closeCursor();
											?>
											<span id="Message">messages</span>
										</p>

										<div id="partie-One-Two-Two">
											<p class="avatar" > <?php echo $contenu['test']; ?></p>
											<p id="partie-One-Two-Two-One">
												<span>Par <span id="membreHierarchie"><?php echo $contenu['idMemb'];?></span></span> 
												<span><?php echo "Il y a : " . $contenu['dateRep'];?></span>
											</p>
										</div>
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




