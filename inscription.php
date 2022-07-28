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
		<title>Inscription</title>
		<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="inscription.css">


	<script type="text/javascript">

		var fieldalias="mot de passe"
		// On Déclare dans la variable fieldalias le type de texte entré

		function verify(element1, element2)
		// La fonction reçois en paramètre les 2 éléments
		 {
		  var passed=false
		// On va donner à la variable passed la valeur false (fausse).

		   if (element1.value=='')
		// si le premier champ est vide (Propriété value vide)
		   {
		    alert("Veuillez entrer votre "+fieldalias+" dans le premier champ!")
		// c'est pas bien il faut le remplir :-)
		// On ouvre donc une boite d'alerte grâce à la méthode alert de l'objet window
		    element1.focus()
		// et on y place le curseur grâce à la méthode focus
		   }

		// puis on va faire exactement la même chose pour le second champ
		   else if (element2.value=='')
		   {
		    alert("Veuillez confirmer votre "+fieldalias+" dans le second champ!")
		    element2.focus()
		   }

		   else if (element1.value!=element2.value)
		/* Si les valeurs des 2 éléments ne sont pas égales (on utilise donc l'opérateur
		  de comparaison d'inégalité != */
		   {
		    alert("Les deux "+fieldalias+" ne condordent pas")
		// toujours la boite d'alerte
		    element1.select()
		// Et la on utilise la méthode select qui permet de selectionner la valeur écrite.
		   }

		   else
		   passed=true
		   return passed
		 }
		// fin du script -->
	</script>

	<?php   // Vérifiacation adresse mail
		if (isset($_POST['forminscription'])) // le boutton "Je m'inscris" envoie bien les infos
		{
		 	$pseudo = htmlspecialchars($_POST['pseudo']);
		 	$mail1 = htmlspecialchars($_POST['mail1']);
		 	$mail2 = htmlspecialchars($_POST['mail2']);
		 	$pass1 = sha1($_POST['pass1']);//password_hash('pass1', PASSWORD_DEFAULT);
		 	$pass2 = sha1($_POST['pass2']);//password_hash('pass2', PASSWORD_DEFAULT);
		 	$date_inscription = date('Y-m-d');

		 	$pseudolenght = strlen($pseudo);
		 	if ($pseudolenght <= 255)
		 	{
				$reqpseudo = $conn->prepare("SELECT * FROM membres WHERE pseudo = ?"); // on regarde si le pseudo est déjà dans la table
				$reqpseudo->execute(array($pseudo)); // Récupère les données "pseudo" de la table
				$bonpseudo = $reqpseudo->fetch();
				$pseudoexist = $reqpseudo->rowCount();
				 // Compte s'il y a d'autes infos qui existent avec "mail1" (pseudo, pass,etc...)
				if ($pseudoexist == 0)
				{
					
				 	if ($mail1 == $mail2) 
				 	{
				 		if (filter_var($mail1, FILTER_VALIDATE_EMAIL)) // Permet de dire si c'est une vraie adresse mail
						 {
						 		$reqmail = $conn->prepare("SELECT * FROM membres WHERE email = ?"); // on regarde si l'adresse est déjà dans la table
						 		$reqmail->execute(array($mail1)); // Récupère les données "mail1" de la table
						 		$mailexist = $reqmail->rowCount();// Compte s'il y a d'autes infos qui existent avec "mail1" (pseudo, pass,etc...)

						 		if ($mailexist == 0) // Si y a pas de colonnes existantes, on peut envoyer
						 		{
						 			$reqpass = $conn->prepare("SELECT * FROM membres WHERE pass = ?"); // on regarde si le mdp est déjà dans la table
						 			$reqpass->execute(array($pass1)); // Récupère les données "pass1" de la table
						 			$passexist = $reqpass->rowCount();// Compte s'il y a d'autes infos qui existent avec "pass1" (pseudo, pass,etc...)

						 			if ($passexist == 0)
						 			{
							 			$requete = "INSERT INTO membres(pseudo,pass,email,date_inscription) VALUES ('$pseudo','$pass1','$mail1','$date_inscription')";
										$conn->exec($requete); // Envoi la requête à la bdd -> membres
										$ok = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
									}
									else
									{
										$erreur = "Ce mot de passe est déjà utilisé !";
									}
						 		}
								else
						 		{
						 			$erreur = "Cette adresse mail est déjà utilisée !";
						 		}
						 }	
						 else
						 {
						 	$erreur = "Votre adresse mail n'est pas valide !";
						 }
				 	}
				 	else
				 	{
				 		 $erreur = "Vos adresses mails ne concordent pas !";
				 	}
				}
				else
				{
				 	$erreur = "Ce pseudo est déjà utilisé !";
				}
			 }
			 else
			 {
			 	$erreur = "Votre pseudo doit faire moins de 255 caractères !";
			 }
		}
	?>

	</head>

	<body>

		<nav class="menu-nav">		
			<ul class="menu_principal">
	            <li class="boutton-renault">
	               <a href="accueil.html">
	                  <img src="image\logo_accueil.png">
	               </a>
	            </li>

	            <li class="boutton">
	               <a href="r3.html">
	                  R3
	               </a>
	               
	            </li>
	            <li class="boutton">
	               <a href="r4_L.html">
	                  R4 L
	               </a>
	            </li>
	            <li class="boutton">
	               <a href="r4_super.html">
	                  R4 SUPER
	               </a>
	            </li>
	            <li class="boutton">
	               <a href="r4_GTL.html">
	                   R4 GTL
	               </a>  
	            </li>

	            <li class="boutton">
	               <a href="4l_trophy.html">
	                  LE 4L TROPHY
	               </a>
	            </li>
	        </ul>
			
			<ul class="menu_deroulant">
				<li class="compte4l">COMPTE 4L</li>
				<ul class="sous_compte4l">
					<li><a href="inscription.php">INSCRIPTION</a></li>
					<li><a href="connexion.php">CONNEXION</a></li>
				</ul>
			</ul>
		</nav>

		<h2> Créez votre compte !</h2>

		<form  onSubmit="return verify(this.pass1, this.pass2)" method="POST" action="">
			<table>
				<tr>
					<td align="right">
						<label> Pseudo :</label>
					</td>
					<td>
						<input type="text" name="pseudo" size="30" placeholder="Votre pseudo" value="" required>
					</td>
				</tr>
					
				<tr>
					<td align="right">
						<label>Adresse mail :</label>
					</td>
					<td>
						<input type="mail" name="mail1" size="30" placeholder="Votre adresse mail" required>
					</td>
				</tr>
				
				<tr>
					<td align="right">
						<label>Confirmation de l'adresse mail :</label>
					</td>
					<td>
						<input type="mail" name="mail2" size="30" placeholder="Confirmez votre adresse mail" required>
					</td>
				</tr>
				
				<tr>
					<td align="right">
						<label>Mot de passe :</label>
					</td>
					<td>
						<input id="password1" type="password" name="pass1" size="30" placeholder="Votre mot de passe" required>
					</td>
				</tr>
				<tr>
					<td align="right">
						<label>Confirmation du mot de passe :</label>
					</td>
					<td>
						<input type="password" name="pass2" size="30" placeholder="Confirmez votre mot de passe" required>
					</td>
				</tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
				<tr>
					<td></td>
					<td>
						<button type="submit" name="forminscription">Je m'inscris</button>
					</td>
				</tr>
				<tr>
					<td class="erreur">
					<?php
						if (isset($erreur))
						{
							echo $erreur;
						}
					?>
					</td>
					<td class="ok">
					<?php 
						if (isset($ok))
						{
							echo $ok;
						}
						?>
					</td>
				</tr>
			</table>
		</form>

		<div class="block-bas">
			<h3 class="contact"> <a href="Contact_me.html"> Contactez-nous</a>  pour plus d'informations</h3>

			<h3 class="actu">Pour suivre notre actualité ==></h3>

			<nav class="menu-bas">
				
				<li class="info">
					<a href="https://www.facebook.com/4l.trophy.officiel"> <img src="image\FB Logo.png"></a>
				</li>
				<li class="info">
					<a href="https://www.instagram.com/4l_trophy/"><img src="image\IT Logo.png"></a>	
				</li>
			</nav>
		</div>

	</body>
</html>