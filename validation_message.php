<?php  
	// Connexion à la base de données
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'compte_4l';

	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);//ne pas mettre d'espace
?>

<!DOCTYPE html>
<html>
<head>
	<title> Validation message </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="">

	<style>
		h3{text-align: center; color: green;}
		h4{text-align: center;}
	</style>

	<?php
			//Récupération des données du formulaire:
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$email = $_POST['email'];
				$message = $_POST['message'];
				$date_message = date('Y-m-d');
				//echo $nom,"<br>",$prenom,"<br>",$email,"<br>",$message,"<br>",$date_message; //Test OK	

			//Envoi des données à la bdd
				if (isset($email) and isset($message))
					{
						$requete = "INSERT INTO contact(nom,prenom,email,message,date_message) VALUES ('$nom','$prenom','$email','$message','$date_message')";
						$conn->exec($requete);
					}
				else {}

	?>


</head>
<body>

<h3> Votre message a bien été envoyé !</h3>

<h4><a href="accueil.html">Retour à l'accueil</a></h4>

</body>
</html>