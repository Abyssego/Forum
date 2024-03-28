<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cookies</title>
	<link rel="stylesheet" type="text/css" href="../css/stylePopupCookies.css">
	<link rel="icon" type="image/x-icon" href="image/logo.png">
</head>
<body>
	<?php session_start(); ?>	

	<div id="totalBouton">
		<button id="btn1" onclick="switchContent(1)"><span>Contenu 1</span></button>
		<button id="btn2" onclick="switchContent(2)"><span>Contenu 2</span></button>
	</div>


	<div id="popup">
	  <div id="popup-content-1">
		<P><span id="titreUtile">À propos des cookies</span><br><br>
			<span id="texteUtile">Les cookies sont des petits fichiers textes qui peuvent être utilisés par les sites web pour rendre l’expérience utilisateur plus efficace.<br>

			La loi stipule que nous ne pouvons stocker des cookies sur votre appareil que s’ils sont strictement nécessaires au fonctionnement de ce site. Pour tous les autres types de cookies, nous avons besoin de votre permission. Cela signifie que les cookies qui sont catégorisés comme nécessaires sont traités sur la base de l’art. 6 (1) lit. F du RGPD. Tous les autres cookies, c’est-à-dire ceux des catégories ‘préférences’ et ‘marketing’, sont traités sur la base de l’art. 6 (1) lit. a du RGPD.<br>

			Ce site utilise différents types de cookies. Certains cookies sont placés par les services tiers qui apparaissent sur nos pages.<br>

			À tout moment, vous pouvez modifier ou retirer votre consentement dès la Déclaration relative aux coolies sur notre site web.<br>

			En savoir plus sur qui nous sommes, comment vous pouvez nous contacter et comment nous traitons les données personnelles veuillez voir notre Politique de confidentialité.<br>
			</span>
		</P>


		<P><br><span id="titreUtile">Consentement</span><br><br>
			<span id="texteUtile">
			Ce site web utilise des cookies.<br>

			Les cookies nous permettent de personnaliser le contenu et les annonces, d’offrir des fonctionnalités relatives aux média sociaux et d’analyser notre trafic. Nous partageons également des informations sur l’utilisation de notre site avec nos partenaires de média sociaux, de publicité et d’analyse, qui peuvent combiner celles-ci avec d’autres informations que vous leur avez fournies ou qu’ils ont collectées lors de votre utilisation de leurs services.
			</span>
		</P>

		<P><br><span id="titreUtile">Cookies détails</span><br><br>
			<span id="texteUtile">
			Nécessaires :<br>
				Cookie de consentement à l’utilisation des cookies – stocker session<br>
				Cookies pour distinguer les humain des robots – stocker session<br>
			Statistique :<br>
				Cookies de visite du site web – stocker session<br>
				Cookies de visite de page du site – stocker session<br>
			</span>
		</P><br><br>

		<div id="totalBouton">
			<button id="accepter" onclick="accepterCookies()">Accepter</button>
			<button id="accepter" onclick="accepterCookies()">Refuser </button>
		</div>
	  </div>
	  





	  <div id="popup-content-2" style="display:none">
	    <P><br><span id="titreUtile">Protection des données</span><br><br>
			<span id="texteUtile">
			Nous prenons la protection de vos données personnelles très au sérieux. Cette politique de confidentialité décrit les types de données personnelles que nous collectons, la façon dont nous les utilisons, et les mesures que nous prenons pour protéger votre vie privée. En utilisant nos services, vous acceptez les termes de cette politique de confidentialité.<br>
			Nous collectons les types de données personnelles suivants : nom, adresse électronique et d'autres informations pertinentes pour nos services. Nous collectons ces informations lorsque vous vous inscrivez pour utiliser nos services, passez une commande, remplissez un formulaire en ligne, ou communiquez avec nous par téléphone, e-mail ou autre moyen.<br>
			Nous utilisons vos données personnelles pour fournir et améliorer nos services, communiquer avec vous, personnaliser votre expérience en ligne, et remplir toutes les obligations légales. Nous pouvons également utiliser vos informations pour vous envoyer des offres spéciales et des mises à jour sur nos produits et services.<br>
			Nous ne vendons, ne louons, ni ne partageons vos informations personnelles avec des tiers sans votre consentement explicite, sauf si cela est nécessaire pour fournir nos services, remplir nos obligations légales, ou protéger nos droits et ceux de nos utilisateurs.<br>
			Nous prenons les mesures de sécurité appropriées pour protéger vos données personnelles contre la perte, l'utilisation abusive, l'accès non autorisé, la modification ou la destruction. Nous utilisons des technologies de sécurité standard du secteur pour protéger vos informations, et nous limitons l'accès à vos données personnelles à un nombre restreint de personnes qui ont besoin de ces informations pour effectuer leur travail.<br>
			Conformément au RGPD, vous avez le droit d'accéder à vos données personnelles, de les rectifier si elles sont incorrectes, de les effacer, de vous opposer à leur traitement, et de demander une limitation du traitement. Vous pouvez exercer ces droits en nous contactant à l'adresse e-mail ou postale indiquée dans les informations du site.<br>
			</span>
		</P>

		<P>
			<span id="texteUtile">
			Identification de la responsabilité de la protection des données (DPO) :<br>
			1.	Finalité du traitement des données personnelles<br>
			2.	Catégories de données personnelles collectées<br>
			3.	Destinataires des données personnelles<br>
			4.	Durée de conservation des données personnelles<br>
			5.	Droits des personnes concernées (droit d'accès, de rectification, d'effacement, etc.)<br>
			6.	Sécurité des données personnelles<br>
			7.	Processus de notification en cas de violation de données<br>
			8.	Politique de cookies et technologies similaires<br>
			9.	Politique de transfert de données à des tiers ou à des pays en dehors de l'Union européenne.<br>

			</span>
		</P>
	  </div>
	</div>






<script src="../javascript/scriptPopupCookies.js"></script>
</body>
</html>






