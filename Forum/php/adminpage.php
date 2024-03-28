<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Page admin</title>
	<link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
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


	<div class="body">

		<?php include("head.php"); ?>


		<div id="categorie">
			<form action='admin2.php' method='post'>
				<p class='Tarticle'>Créer une categorie</p>
				<label for="idCategorie">id Categorie: </label>
				<input type='text' name='idCategorie' class='contenu'/><br/>

				<label for="nomCategorie">Nom Categorie :</label>
				<input type='text' name='nomCategorie' class='sujet'/><br/>

				<input type='submit' name='ValArticle' id="boutton"/>
			</form>
		</div>

		<div id="categorie">
			<form action='admin2.php' mathod='post'>
				<p class=Trubriques>Ajouter une rubrique</p>
				<label for="nomRubrique">Nom rubrique : </label>
				<input type='text' name='nomRubrique' class='nmrub'/><br/>

				<label for="descRubrique">Description rubrique : </label>
				<textarea name='descRubrique' class='descrub'></textarea><br/>

				<select name="idRubrique">
				<?php
				$resultat = $cnn -> prepare('SELECT idCat, nomCat FROM categorie');

				$resultat->execute();

				while ($row = $resultat -> fetch())
				{ ?>
					<option value="<?php echo $row['idCat']; ?>">  <?php echo $row['idCat'] . " - " . $row['nomCat'] . '<br/>'; ?> </option>
					<?php
				}

				$resultat->closeCursor();
				?>
				</select><br/>

				<input type='submit' name='ValRubrique' id="boutton"/>
			</form>
		</div>

		<div id="categorie">
			<form action='admin2.php' mathod='post'>
				<p class='Tarticle'>Créer un article</p>

				<label for="idArticle">id article :</label>
				<input type='text' name='idArticle' class='sujet'/> <br/>

				<label for="titreArticle">Titre article :</label>
				<input type='text' name='titreArticle' class='sujet'/> <br/>

				<label for="contenuArticle">Contenu article :</label>
				<textarea name='contenuArticle' class='sujet'></textarea><br/>

				
				<?php
				$resultat = $cnn -> prepare('SELECT nomMemb, prenomMemb FROM membre');

				$resultat->execute();
				?>
				<select name="idMembre">
				<?php
				while ($row = $resultat -> fetch())
				{ ?>
					
					<option value="<?php echo $row['nomMemb']; ?>">  <?php echo $row['nomMemb'] . " - " . $row['prenomMemb'] . '<br/>'; ?> </option>
					<?php
				}

				$resultat->closeCursor();
				?>	
				</select><br/>

				<?php
				$resultat = $cnn -> prepare('SELECT idRub, nomRub FROM rubrique');

				$resultat->execute();
				?>
				<select name="idRubrique">
				<?php
				while ($row = $resultat -> fetch())
				{ ?>
					<option value="<?php echo $row['idRub']; ?>"> <?php echo $row['idRub'] . " - " . $row['nomRub'] . '<br/>'; ?> </option>
					<?php
				}

				$resultat->closeCursor();
				?>	
				</select><br/>			

				<input type='submit' name='ValArticle' id="boutton"/>
			</form>
		</div>


		<div id="categorie">
			<form action='admin2.php' method='post'>
				<p class='Tmembre'>Ajouter un membre</p>

				<label for="idMembre">Adresse mail :</label>
				<input type='text' name='idMembre' class='role'/><br/>

				<label for="nomMembre">Nom Membre :</label>
				<input type='text' name='nomMembre' class='role'/><br/>

				<label for="prenomMembre">Prenom Membre :</label>
				<input type='text' name='prenomMembre' class='role'/><br/>

				<label for="mdpMembre">Mot de passe :</label>
				<input type='password' name='mdpMembre' class='role'/><br/>
				
				<select name="idRang">
				<?php
				$compteur = 1;
				while ($compteur != 4)
				{ ?>
					<option value="<?php echo $compteur; ?>"> <?php echo $compteur . '<br/>'; ?> </option>
					<?php
					$compteur++;
				}

				$resultat->closeCursor();
				?>	

				</select><br/>

				<input type='submit' name='ValMembre' id="boutton"/>
			</form>
		</div>



		<div id="categorie">
			<form action='admin2.php' method='post'>
				<p class='Tmembre'>Ajouter une réponse</p>

				<label for="idReponse">id Reponse :</label>
				<input type='text' name='idReponse' class='role'/><br/>


				<?php
				$resultat = $cnn -> prepare('SELECT nomMemb, prenomMemb FROM membre');

				$resultat->execute();
				?>
				<select name="idMembre">
				<?php
				while ($row = $resultat -> fetch())
				{ ?>
					
					<option value="<?php echo $row['nomMemb']; ?>">  <?php echo $row['nomMemb'] . " - " . $row['prenomMemb'] . '<br/>'; ?> </option>
					<?php
				}

				$resultat->closeCursor();
				?>	
				</select><br/>



				<?php
				$resultat = $cnn -> prepare('SELECT idArt, titreArt FROM article');

				$resultat->execute();
				?>
				<select name="idArticle">
				<?php
				while ($row = $resultat -> fetch())
				{ ?>
					<option value="<?php echo $row['idArt']; ?>"> <?php echo $row['idArt'] . " - " . $row['titreArt'] . '<br/>'; ?> </option>
					<?php
				}

				$resultat->closeCursor();
				?>	
				</select><br/>	



				<label for="contenuReponse">Contenu Réponse :</label>
				<textarea name='contenuReponse' class='role'></textarea><br/>
				

				<input type='submit' name='ValMembre' id="boutton"/>
			</form>
		</div>




		<div id="categorie">
			<form action='admin2.php' method='post'>
				<p class='Tmembre'>Supprimer une réponse</p>

				<label for="idReponse">id Reponse :</label>
				<input type='text' name='idReponse' class='role'/><br/>


				<?php
				$resultat = $cnn -> prepare('SELECT idCat, nomCat FROM categorie');

				$resultat->execute();
				?>
				<select name="idCategorie">
				<?php
				while ($row = $resultat -> fetch())
				{ ?>
					<option value="<?php echo $row['idCat']; ?>"> <?php echo $row['idCat'] . " - " . $row['nomCat'] . '<br/>'; ?> </option>
					<?php
				}

				$resultat->closeCursor();
				?>	
				</select><br/>
			</form>	

				<?php
				if (isset($_POST['idCategorie']))
					{
					$resultat = $cnn -> prepare('SELECT idRub, nomRub FROM rubrique WHERE idCat = :idArticle');
					$resultat->bindParam(':idArticle', $_POST['idArticle'], PDO::PARAM_INT);

					$resultat->execute();
					?>
					<select name="idRubrique">
					<?php
					while ($row = $resultat -> fetch())
					{ ?>
						<option value="<?php echo $row['idRub']; ?>"> <?php echo $row['idRub'] . " - " . $row['nomRub'] . '<br/>'; ?> </option>
						<?php
					}

					$resultat->closeCursor();
					?>	
					</select><br/>	


					<?php	
					if (isset($_POST['idRubrique'])) 
					{
						$resultat = $cnn -> prepare('SELECT idArt, titreArt FROM article WHERE idRub = :idRubrique');
						$resultat->bindParam(':idRubrique', $_POST['idRubrique'], PDO::PARAM_INT);

						$resultat->execute();
						?>
						<select name="idArticle">
						<?php
						while ($row = $resultat -> fetch())
						{ ?>
							<option value="<?php echo $row['idArt']; ?>"> <?php echo $row['idArt'] . " - " . $row['titreArt'] . '<br/>'; ?> </option>
							<?php
						}

						$resultat->closeCursor();
						?>	
						</select><br/>

						<?php
						if (isset($_POST['idArticle'])) {
							$resultat = $cnn -> prepare('SELECT idRep, contenuRep, nomMemb, prenomMemb FROM reponse
														JOIN membre ON reponse.idMemb = membre.idMemb WHERE idArt = :idArticle');
							$resultat->bindParam(':idArticle', $_POST['idArticle'], PDO::PARAM_INT);

							$resultat->execute();
							?>
							<select name="idArticle">
							<?php
							while ($row = $resultat -> fetch())
							{ ?>
								<option value="<?php echo $row['idArt']; ?>"> <?php echo $row['idArt'] . " - " . $row['titreArt'] . '<br/>'; ?> </option>
								<?php
							}

							$resultat->closeCursor();
							?>	
							</select><br/>
							<?php
						}
					}			
				}
				?>




				<?php
				$resultat = $cnn -> prepare('SELECT idRep, contenuRep, nomMemb, prenomMemb FROM reponse
											JOIN membre ON reponse.idMemb = membre.idMemb');

				$resultat->execute();
				?>
				<select name="idArticle">
				<?php
				while ($row = $resultat -> fetch())
				{ ?>
					<option value="<?php echo $row['idArt']; ?>"> <?php echo $row['idArt'] . " - " . $row['titreArt'] . '<br/>'; ?> </option>
					<?php
				}

				$resultat->closeCursor();
				?>	
				</select><br/>	







				<?php
				$resultat = $cnn -> prepare('SELECT idRep, contenuRep, nomMemb, prenomMemb FROM reponse
											JOIN membre ON reponse.idMemb = membre.idMemb');

				$resultat->execute();
				?>
				<select name="idArticle">
				<?php
				while ($row = $resultat -> fetch())
				{ ?>
					<option value="<?php echo $row['idArt']; ?>"> <?php echo $row['idArt'] . " - " . $row['titreArt'] . '<br/>'; ?> </option>
					<?php
				}

				$resultat->closeCursor();
				?>	
				</select><br/>	



				<label for="idArticle">Prenom Membre :</label>
				<input type='text' name='idArticle' class='role'/><br/>

				<label for="contenuReponse">Mot de passe :</label>
				<input type='text' name='contenuReponse' class='role'/><br/>
			

				<input type='submit' name='ValMembre' id="boutton"/>
			</form>
		</div>

	</div>
	<?php
	$cnn=null;
	?>


</body>
</html>