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
		<title>Validation compte</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="">

		<?php
			//Récupération des données du formulaire:
				$pseudo = htmlspecialchars($_POST['pseudo']) ;
				$pass1 = sha1(($_POST['pass1']));
				$pass2 = sha1($_POST['pass2']);
				$mail1 = htmlspecialchars($_POST['mail1']);
				$mail2 = htmlspecialchars($_POST['mail2']);
				$date_inscription = date('Y-m-d');
				echo $pseudo,"<br>",$pass1,"<br>",$pass2,"<br>",$mail1,"<br>",$mail2,"<br>",$date_inscription; //Test OK
			
			//Envoi des données à la bdd
				if (isset($pseudo))
				{
					$requete = "INSERT INTO membre(pseudo,pass,email,date_inscription) VALUES ('$pseudo','$pass1','$mail1','$date_inscription')";
					$conn->exec($requete);
				}
				else {}
		?>
	</head>

	<body>
		<?php
			
		?>
	</body>

</html>