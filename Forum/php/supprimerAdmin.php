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
			<form method="post">
				<label for="idRep">Supprimer réponse (id) :</label>
				<input type="text" id="idRep" name="idRep">
				<button type="submit" name="submit">Supprimer</button>
			</form>
			<?php
			// vérifier si le formulaire a été soumis
			if (isset($_POST['submit'])) {
				// se connecter à la base de données
				$conn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
			// vérifier la connexion
			if ($conn->connect_error) {
				die("La connexion à la base de données a échoué : " . $conn->connect_error);
			}
			// récupérer le numéro de clé primaire soumis
			$idRep = $_POST['idRep'];
			// construire la requête de suppression
			$sql = "DELETE FROM reponse WHERE idRep = $idRep";
			// exécuter la requête de suppression
			if ($conn->query($sql) === TRUE) {
				echo "La réponse a été supprimée avec succès.";
			} else {
				echo "";
			}

			}
			?>
		</div>
		<div id="categorie">
			<form method="post">
				<label for="idCat">Supprimer une catégorie (id) :</label>
				<input type="text" id="idCat" name="idCat">
				<button type="submit" name="submit">Supprimer</button>
			</form>
			<?php
			// vérifier si le formulaire a été soumis
			if (isset($_POST['submit'])) {
				// se connecter à la base de données
				$conn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
			// vérifier la connexion
			if ($conn->connect_error) {
				die("La connexion à la base de données a échoué : " . $conn->connect_error);
			}
			// récupérer le numéro de clé primaire soumis
			$idCat = $_POST['idCat'];
			// construire la requête de suppression
			$sql = "DELETE FROM categorie WHERE idCat = $idCat";
			// exécuter la requête de suppression
			if ($conn->query($sql) === TRUE) {
				echo "La catégorie a été supprimée avec succès.";
			} else {
				echo "";
			}
			
			}
			?>
		</div>
		<div id="categorie">
			<form method="post">
				<label for="idRub">Supprimer une rubrique (id) :</label>
				<input type="text" id="idRub" name="idRub">
				<button type="submit" name="submit">Supprimer</button>
			</form>
			<?php
			// vérifier si le formulaire a été soumis
			if (isset($_POST['submit'])) {
				// se connecter à la base de données
				$conn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
			// vérifier la connexion
			if ($conn->connect_error) {
				die("La connexion à la base de données a échoué : " . $conn->connect_error);
			}
			// récupérer le numéro de clé primaire soumis
			$idRub = $_POST['idRub'];
			// construire la requête de suppression
			$sql = "DELETE FROM rubrique WHERE idRub = $idRub";
			// exécuter la requête de suppression
			if ($conn->query($sql) === TRUE) {
				echo "La rubrique a été supprimée avec succès.";
			} else {
				echo "";
			}
			
			
			}
			?>
		</div>
		<div id="categorie">
	<form method="post">
		<label for="nomMemb">Supprimer un membre (nom) :</label>
		<input type="text" id="nomMemb" name="nomMemb">
		<button type="submit" name="submit">Supprimer</button>
	</form>
	<?php
		// vérifier si le formulaire a été soumis
		if (isset($_POST['submit'])) {
			// se connecter à la base de données
			$conn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
			// vérifier la connexion
			if ($conn->connect_error) {
				die("La connexion à la base de données a échoué : " . $conn->connect_error);
			}
			// récupérer le nom du membre soumis
			$nomMemb = $_POST['nomMemb'];
			// construire la requête de suppression
			$sql = "DELETE FROM membre WHERE nomMemb = '$nomMemb'";
			// exécuter la requête de suppression
			if ($conn->query($sql) === TRUE) {
				echo "Le membre a été supprimé avec succès.";
			} else {
				echo "Erreur lors de la suppression du membre : " . $conn->error;
			}
			}
		?>
		</div>

		<div id="categorie">
			<form method="post">
				<label for="idArt">Supprimer un article (id) :</label>
				<input type="text" id="idArt" name="idArt">
				<button type="submit" name="submit">Supprimer</button>
			</form>
			<?php
			// vérifier si le formulaire a été soumis
			if (isset($_POST['submit'])) {
				// se connecter à la base de données
				$conn = new mysqli('localhost', 'root', 'xawo7536', 'Forum');
			// vérifier la connexion
			if ($conn->connect_error) {
				die("La connexion à la base de données a échoué : " . $conn->connect_error);
			}
			// récupérer le numéro de clé primaire soumis
			$idArt = $_POST['idArt'];
			// construire la requête de suppression
			$sql = "DELETE FROM article WHERE idArt = $idArt";
			// exécuter la requête de suppression
			if ($conn->query($sql) === TRUE) {
				echo "L'article a été supprimée avec succès.";
			} else {
				echo "";
			}
			}
			?>
		</div>


		<?php
		// fermer la connexion à la base de données
			$conn->close();
		?>
	</div>

</body>
</html>