<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Page admin</title>
	<link rel="stylesheet" type="text/css" href="../css/styleSupprimerAdmin.css">
	<link rel="icon" type="image/x-icon" href="../image/logo.png">
</head>
<body>
	<?php   //Script pour afficher le nombre total de messages
	$host = "localhost";    //Nom de l'hôte
	$bdd = "Forum";       //Nom de la base de données
	$user = "root";
	$password = "root";

	//On essaie de se connecter
	try {    //Connexion à la base et au serveur
		$conn = new PDO("mysql:host=$host;dbname=$bdd;charset=utf8",$user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	// En cas d'erreur, on affiche un message et on arrête tout
	catch(PDOException $e) {
		echo "Erreur : " . $e->getMessage();
	}
	?>
	<div class="body">
		<?php include("head.php"); ?> 
		<div id="categorie">
			<form method="post">
				<p class='Tarticle'>Créer une catégorie</p>
				<label for="idCat">ID :</label>
				<input type="text" id="idCat" name="idCat"><br>
				<label for="nomCat">Nom :</label>
				<input type="text" id="nomCat" name="nomCat"><br>
				<button type="submit" name="submit1">Ajouter</button>
			</form>
			<?php
			// vérifier si le formulaire a été soumis
			if (isset($_POST['submit1'])) {
				// se connecter à la base de données
				$conn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
				// vérifier la connexion
				if ($conn->connect_error) {
					die("La connexion à la base de données a échoué : " . $conn->connect_error);
				}
				// récupérer les données soumises
				$idCat = $_POST['idCat'];
				$nomCat =$_POST['nomCat'];
				// construire la requête d'insertion
				$sql = "INSERT INTO categorie (idCat, nomCat) VALUES ('$idCat', '$nomCat')";
				// exécuter la requête d'insertion
				if ($conn->query($sql) === TRUE) {
					echo "La catégorie a été ajoutée avec succès.";
					//...
				} else {
					echo "";
				}

			}
			?>
		</div>
		
		<div id="categorie">
			<form method="post">
				<p class="Tarticle">Créer une réponse</p>
				<label for="nomMemb">Nom du membre :</label>
				<input type="text" id="nomMemb" name="nomMemb"><br>
				<label for="idArt">ID de l'article :</label>
				<input type="text" id="idArt" name="idArt"><br>
				<label for="contenu">Contenu :</label>
				<input type="text" id="contenu" name="contenu"><br>
				<button type="submit" name="submit2">Ajouter</button>
			</form>
			<?php
		// Vérifier si le formulaire a été soumis
			if (isset($_POST['submit2'])) {
			// Se connecter à la base de données
				$conn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
			// Vérifier la connexion
				if ($conn->connect_error) {
					die("La connexion à la base de données a échoué : " . $conn->connect_error);
				}
			// Récupérer l'ID du membre en fonction de son nom
				$nomMemb = $_POST['nomMemb'];
				$sql_membre = "SELECT idMemb FROM membre WHERE nomMemb = '$nomMemb'";
				$result_membre = $conn->query($sql_membre);
				if ($result_membre->num_rows > 0) {
					$row_membre = $result_membre->fetch_assoc();
					$idMemb = $row_membre['idMemb'];
				} else {
					echo "Le membre n'existe pas.";
					exit;
				}
			// Récupérer l'ID de l'article soumis
				$idArt = $_POST['idArt'];
				$contenu = $_POST['contenu'];
				$dateRep = date("Y-m-d H:i:s");
			// Construire la requête d'insertion
				$sql = "INSERT INTO reponse (idMemb, idArt, contenuRep, dateRep) VALUES ('$idMemb', '$idArt', '$contenu', '$dateRep')";
			// Exécuter la requête d'insertion
				if ($conn->query($sql) === TRUE) {
					echo "La réponse a été ajoutée avec succès.";
				} else {
					echo "Une erreur s'est produite lors de l'ajout de la réponse : " . $conn->error;
				}

			}
			?>
		</div>
		<div id="categorie">
			<form method="post">
				<p class="Tarticle">Créer une rubrique</p>
				<label for="nomRub">Nom de la rubrique :</label>
				<input type="text" id="nomRub" name="nomRub"><br>
				<label for="descRub">Description :</label>
				<input type="text" id="descRub" name="descRub"><br>
				<label for="nomCat">Catégorie :</label>
				<select id="nomCat" name="nomCat">
					<option value="Matières technologiques">Matières technologiques</option>
					<option value="Matières générales">Matières générales</option>
					<option value="Les niveaux">Les niveaux</option>
				</select><br>
				<button type="submit" name="submit3">Ajouter</button>
			</form>
			<?php
	// Vérifier si le formulaire a été soumis
			if (isset($_POST['submit3'])) {
		// Se connecter à la base de données
				$conn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
		// Vérifier la connexion
				if ($conn->connect_error) {
					die("La connexion à la base de données a échoué : " . $conn->connect_error);
				}
		// Récupérer l'ID de la catégorie sélectionnée
				$nomCat = $_POST['nomCat'];
				$sql_cat = "SELECT idCat FROM categorie WHERE nomCat = '$nomCat'";
				$result_cat = $conn->query($sql_cat);
				if ($result_cat->num_rows > 0) {
					$row_cat = $result_cat->fetch_assoc();
					$idCat = $row_cat['idCat'];
				} else {
					echo "La catégorie n'existe pas.";
					exit;
				}
		// Récupérer les données du formulaire
				$nomRub = $_POST['nomRub'];
				$descRub = $_POST['descRub'];
		// Construire la requête d'insertion
				$sql = "INSERT INTO rubrique (nomRub, descRub, idCat) VALUES ('$nomRub', '$descRub', '$idCat')";
		// Exécuter la requête d'insertion
				if ($conn->query($sql) === TRUE) {
					echo "La rubrique a été ajoutée avec succès.";
				} else {
					echo "Une erreur s'est produite lors de l'ajout de la rubrique : " . $conn->error;
				}
			}
			?>
		</div>
		<div id="categorie">
			<form method="post">
				<p class="Tarticle">Ajouter un membre</p>
				<label for="idMemb">ID du membre :</label>
				<input type="text" id="idMemb" name="idMemb"><br>
				<label for="nomMemb">nom du membre :</label>
				<input type="text" id="nomMemb" name="nomMemb"><br>
				<label for="prenomMemb">prénom du membre :</label>
				<input type="text" id="prenomMemb" name="prenomMemb"><br>
				<label for="mdpMemb">mot de passe  :</label>
				<input type="text" id="mdpMemb" name="mdpMemb"><br>
				<select id="typeMemb" name="typeMemb">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select><br>
				<button type="submit" name="submit4">Ajouter</button>
			</form>
			<?php
		// Vérifier si le formulaire a été soumis
			if (isset($_POST['submit4'])) {
			// Se connecter à la base de données
				$conn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
			// Vérifier la connexion
				if ($conn->connect_error) {
					die("La connexion à la base de données a échoué : " . $conn->connect_error);
				}
			// Récupérer l'ID de l'article soumis
				$idMemb = $_POST['idMemb'];
				$nomMemb = $_POST['nomMemb'];
				$prenomMemb = $_POST['prenomMemb'];
				$mdpMemb = $_POST['mdpMemb'];
				$dateIns = date("Y-m-d H:i:s");
				$typeMemb = $_POST['typeMemb'];
				
			// Construire la requête d'insertion
				$sql = "INSERT INTO membre (idMemb, nomMemb, prenomMemb, mdpMemb, dateIns, typeMemb) VALUES ('".$idMemb."', '$nomMemb', '$prenomMemb', '$mdpMemb', '$dateIns', '$typeMemb')";

			// Exécuter la requête d'insertion
				if ($conn->query($sql) === TRUE) {
					echo "Le membre a été ajoutée avec succès.";
				} else {
					echo "" . $conn->error;
				}

			}
			?>
		</div>
		<div id="categorie">
			<form method="post">
				<p class="Tarticle">Ajouter un article</p>
				<label for="idArt">ID de l'article :</label>
				<input type="text" id="idArt" name="idArt"><br>
				<label for="titreArt">titre article :</label>
				<input type="text" id="titreArt" name="titreArt"><br>
				<label for="contenuArt">contenu :</label>
				<input type="text" id="contenuArt" name="contenuArt"><br>
				<label for="idMemb">id membre :</label>
				<input type="text" id="idMemb" name="idMemb"><br>
				<label for="idRub">id rubrique :</label>
				<input type="text" id="idRub" name="idRub"><br>
				<button type="submit" name="submit4">Ajouter</button>
			</form>
			<?php
	// Vérifier si le formulaire a été soumis
	if (isset($_POST['submit4'])) {
		// Se connecter à la base de données
		$conn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
		// Vérifier la connexion
		if ($conn->connect_error) {
			die("La connexion à la base de données a échoué : " . $conn->connect_error);
		}
		// Récupérer les valeurs soumises par le formulaire
		$idArt = $_POST['idArt'];
		$titreArt = $_POST['titreArt'];
		$contenuArt = $_POST['contenuArt'];
		$idMemb = $_POST['idMemb'];
		$dateArt = date("Y-m-d H:i:s");
		$idRub = $_POST['idRub'];
		
		// Construire la requête d'insertion
		$sql = "INSERT INTO article (idArt, titreArt, contenuArt, idMemb, dateArt, idRub) VALUES ('$idArt', '$titreArt', '$contenuArt', '$idMemb', '$dateArt', '$idRub')";
		
		// Exécuter la requête d'insertion
		if ($conn->query($sql) === TRUE) {
			echo "L'article a été ajouté avec succès.";
		} else {
			echo "Une erreur s'est produite lors de l'ajout de l'article : " . $conn->error;
		}
		
		// Fermer la connexion à la base de données
		$conn->close();
	}
?>
	</body>
	</html>