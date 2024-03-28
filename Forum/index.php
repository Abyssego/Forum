<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Page d'accueil</title>
	<link rel="stylesheet" type="text/css" href="styleIndex.css">
	<link rel="icon" type="image/x-icon" href="image/logo.png">
</head>
<body>
		<?php
		session_start();


		if (!isset($_SESSION['actualiser'])) { //Vérifie si la variable existe non.
		    $_SESSION['actualiser'] = false;
		}



		if($_SESSION['captchaVerifie'] != true) {?>
			<form method="post" action="" id="formCatcha">
			  <label for="captcha">Captcha:</label>
			  <img id="captcha" src="catcha.php" alt="Captcha" />
			  <a href="#" onclick="refreshCaptcha();">Recharger</a><br />
			  <?php echo '<input type="text" id="captcha" name="captcha" /><br />';?>
			  <input type="submit" name="submit" value="Envoyer"/>
			</form>
			<?php
		}

			if(isset($_POST['submit'])) {
			  if($_POST['captcha'] == $_SESSION['captcha']) {
			  	$_SESSION['captchaVerifie'] = true;
			  }
			 }
		
		if($_SESSION['captchaVerifie'] == true) {

			
			if ($_SESSION['actualiser'] == false) {
			    header("refresh: 1");  // Actualiser la page pour enlever le catcha
			    $_SESSION['actualiser'] = true;
			}

						if ($_SESSION['isLogin'] == "yes") { 
							?>
							<div class="head">
								<ul>	
									<li id="nav"><img id="logo" src="../image/logo.png" alt="Forum BTS SIO"></li>
									<li id="nav"><a href="../index.php" id="normal">Accueil</a></li>
									<li><a href="php/profil.php" id="reste">Mon compte</a></li>	
								</ul>		
							</div>
							<?php 
						} else {
							?>
							<div class="head">
								<ul>	
									<li id="nav"><img id="logo" src="../image/logo.png" alt="Forum BTS SIO"></li>
									<li id="nav"><a href="../index.php" id="normal">Accueil</a></li>
									<li><a href="php/signUp.php" id="reste">S'inscrire</a></li>	
									<li><a href="php/login.php" id="reste">Se connecter</a></li>
								</ul>		
							</div> 
						<?php
						}
						?>



					<div class="body">

						<?php
						$_SESSION['cookiesAccepte'] = false;

						// Vérifier si l'utilisateur a déjà accepté les cookies
						if (!isset($_COOKIE['cookiesAccepte'])) {
						    // Si les cookies n'ont pas encore été acceptés, afficher une popup en utilisant l'événement onload pour s'assurer qu'elle s'ouvre dès que la page est chargée
						    echo '
						        <script>
						            window.onload = function() {
						                ouvrePopup("php/popupCookies.php");
						            };
						        </script>
						    ';
						}
						?>


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


							$resultat = $cnn -> prepare('SELECT idCat, nomCat
														 FROM categorie');

							$resultat->execute();
							?>
							<div id="partie-One">
							<?php
							while ($row = $resultat -> fetch())
							{ ?>
								
								
								
								<div id="partie-One-One">
									<p id="titre"> <?php echo $row['nomCat'];?> <p>
								</div>
								<div id="partie-One-Two">
									
									
									<?php
										$total = $cnn -> prepare('SELECT idRub
										 FROM rubrique
										 WHERE rubrique.idCat = "' . $row['idCat'] .'" ');

										$total->execute();

										while ($ligne = $total -> fetch())
										{ ?>


											<?php
												$conca = $cnn -> prepare('SELECT nomCat, categorie.idCat, DATE_FORMAT(dateRep, "%d/%m/%Y"), article.idMemb, membre.typeMemb, prenomMemb, rubrique.idRub, titreArt, COUNT(reponse.idRep), nomRub, descRub, substring(prenomMemb, 1, 1) as test
										 									FROM categorie
																			 INNER JOIN rubrique ON categorie.idCat = rubrique.idCat
																			 INNER JOIN article ON rubrique.idRub = article.idRub
																			 INNER JOIN membre ON article.idMemb = membre.idMemb
																			 INNER JOIN reponse ON membre.idMemb = reponse.idMemb
																			 WHERE categorie.idCat = :idCat AND rubrique.idRub = :idRub');
												$conca->bindParam(':idCat', $row['idCat'], PDO::PARAM_INT);
												$conca->bindParam(':idRub', $ligne['idRub'], PDO::PARAM_INT);
												$conca->execute();


												while ($contenu = $conca -> fetch())
												{ ?>	
													<img id="logo" src="image/logo.png">
													<p id="rebrique">	
									
														<span id="sousTitre"><a href="php/rubrique.php?numRubrique=<?php echo $contenu['idRub'];?>"><?php echo $contenu['nomRub'];?></a></span><br>
														<span id="description"><?php echo $contenu['descRub'];?></span> 
													</p>
													<p id="partie-One-Two-One">
														<?php
														$nombreReponse = $cnn -> prepare('SELECT COUNT(reponse.idRep) + COUNT(DISTINCT article.idArt) as totalReponse
										 									 FROM rubrique
																			 INNER JOIN article ON rubrique.idRub = article.idRub
																			 INNER JOIN reponse ON article.idArt = reponse.idArt
																			 WHERE rubrique.idRub = :idRubrique');
														$nombreReponse->bindParam(':idRubrique', $ligne['idRub'], PDO::PARAM_INT);
														$nombreReponse->execute();
														if($afficheNombreReponse = $nombreReponse -> fetch()) { ?>
															<span id="nombreMessage"><?php echo $afficheNombreReponse['totalReponse'];?></span> <?php
														} 
														$nombreReponse->closeCursor();
														?>
														

														<span id="Message">messages</span>
													</p>

													<div id="partie-One-Two-Two">
														<!--<img id="imageProfile" src="image/imageProfile.png">-->
														<p class="avatar" > <?php echo $contenu['test']; ?></p>
														<p id="partie-One-Two-Two-One">
															<span id="test"><?php echo $contenu['titreArt'];?></span>

															<?php
															if ($contenu['typeMemb']==3)
															{
																echo "<span>Par <span id='membreHierarchie'><span class='admin'>" . $contenu['prenomMemb'] . "</span></span></span>"; 
															}
															if ($contenu['typeMemb']==2)
															{
																echo "<span>Par <span id='membreHierarchie'><span class='modo'>" . $contenu['prenomMemb'] . "</span> </span></span>";
															}
															if ($contenu['typeMemb']==1)
															{
																 echo "<span>Par <span id='membreHierarchie'><span class='paysan'>" . $contenu['prenomMemb'] . "</span></span></span>";
															}
															?>


															

															<span id="date"><?php echo $contenu['DATE_FORMAT(dateRep, "%d/%m/%Y")'];?></span>
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

					</div>








					<div class="footer">
						<div id="case-One">
							<div id="partie-One-One">
								<p id="titre">Statistique du forum</p>
							</div>

							<div id="partie-One-Two"> 
								<div id="partie-One-Two-One">
									<p>		

										<?php   //Scipt pour afficher le nombre total d'ariticle
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

											$resultat = $cnn -> prepare("SELECT COUNT(idArt) FROM article");
											$resultat->execute();

											while ($row = $resultat -> fetch())
											{ ?>
												
												<span><?php echo $row['COUNT(idArt)'] .  '<br/>'; ?></span><br>
											
												
												<?php
											}
											$resultat->closeCursor();
										?>

										
										<span>Total des articles</span>
									</p>
								</div>
								<div id="partie-One-Two-Two">
									<p>

									<?php   //Scipt pour afficher le nombre total de message


											$resultat = $cnn -> prepare("SELECT COUNT(idRep) FROM reponse");
											$resultat->execute();

											while ($row = $resultat -> fetch())
											{ ?>
												
												<span><?php echo $row['COUNT(idRep)'] .  '<br/>'; ?></span><br>
											
												
												<?php
											}
											$resultat->closeCursor();
										?>				
										<span>Total des messages</span>
									</p>
								</div>
							</div>
						</div>



						<div id="case-Two">
							<div id="partie-Two-One">
								<p id="titre">Statistique des membres</p>
							</div>

							<div id="partie-Two-Two"> 
								<div id="partie-Two-Two-One">
									<p>
									<?php   //Scipt pour afficher le nombre total de message


											$resultat = $cnn -> prepare("SELECT COUNT(idMemb) FROM membre");
											$resultat->execute();

											while ($row = $resultat -> fetch())
											{ ?>
												
												<span><?php echo $row['COUNT(idMemb)'] .  '<br/>'; ?></span><br>						
												
												<?php
											}
											$resultat->closeCursor();
										?>
										<span>Total des membres</span>
									</p>
								</div>
								<div id="partie-Two-Two-Two">
										<p id="partie-Two-Two-Two-One"> </p>
											<span>Le membre le plus récent, est :</span>

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

												$resultat = $cnn -> prepare('SELECT nomMemb, DATE_FORMAT(dateIns, "%d/%m/%Y") , substring(prenomMemb, 1, 1) as test FROM membre ORDER BY DATE_FORMAT(dateIns, "%d/%m/%Y") DESC LIMIT 1;');
												$resultat->execute();

												while ($row = $resultat -> fetch())
												{ ?>
													<p class="avatar" > <?php echo $row['test']; ?></p>
													<span><?php echo $row['nomMemb']; ?></span><br>
													<span>Membre depuis : <?php echo $row['DATE_FORMAT(dateIns, "%d/%m/%Y")'] . '<br/>'; ?> </span>
													

													
													<?php
												}
												$resultat->closeCursor();
												$cnn=null;
												
											?>
												
									</p>
								</div>
							</div>
						</div>
					</div> <?php
		}
		?>


<script src="scriptIndex.js"></script>
</body>
</html>






