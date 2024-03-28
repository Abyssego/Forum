<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="stylettt.css">
	<title>Insérer des données dans une table</title>
</head>
<body>
<?php
	// Démarrer la session PHP pour stocker les cookies de session
	session_start();

	// Vérifier si l'utilisateur a déjà accepté les cookies
	if (!isset($_SESSION['cookie_accepted'])) {
	    // Si les cookies n'ont pas été acceptés, afficher la pop-up
	    echo "<script>
	    if (confirm('Nous utilisons des cookies pour améliorer votre expérience utilisateur. Acceptez-vous les cookies ?')) {
	        // Si l'utilisateur accepte les cookies, définir un cookie de session pour se souvenir de son choix
	        $_SESSION['cookie_accepted'] = 1;
	    } else {
	        // Si l'utilisateur refuse les cookies, rediriger vers une page qui ne nécessite pas de cookies
	        header('Location: page_sans_cookies.php');
	        exit;
	    }
	    </script>";
	}
?>
</body>
</html> 