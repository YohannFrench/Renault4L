<?php
   // Démarrage de la session
   session_start();

   // Connexion à la base de données
   $servername = 'localhost';
   $username = 'root';
   $password = '';
   $dbname = 'compte_4l';

   $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);//ne pas mettre d'espace
?>

<?php
   if (isset($_POST['formconnexion']))
   {
      $mailconnect = htmlspecialchars($_POST['mailconnect']);
      $passconnect = sha1($_POST['passconnect']);//password_hash('passconnect', PASSWORD_DEFAULT);

      $requser = $conn->prepare("SELECT * FROM membres WHERE email = ? and pass= ?"); //on regarde si le mail et le mdp sont déjà dans la table
      $requser->execute(array($mailconnect,$passconnect)); // Récupère les données "mail" et "pass" de la table
      $userexist = $requser->rowCount(); // Compte s'il y a d'autes infos qui existent avec "mail1" (pseudo, pass,etc...)
      if ($userexist == 1)
      {
         //Réglage des variables de session
         $userinfo = $requser -> fetch();
         $_SESSION["id"] = $userinfo['id'];
         $_SESSION["pseudo"] = $userinfo['pseudo'];
         $_SESSION["email"] = $userinfo['email'];
         header('Location: profil.php?id='.$_SESSION['id']);
      }
      else
      {
         $erreur="Mauvais mail ou mot de passe !";
      }
   }
?>


<!DOCTYPE html>
<html>
   <head>
   	<title>Connexion au compte</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="connexion.css">

      

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

      <h2>Connectez-vous à votre compte ! </h2>

   	<form name="formconnexion" method="POST" action="">
   		<table>
            <tr>    
               <td align="right">  
                  <label for="AdMail">Adresse mail :</label>
               </td>
               <td>
            		<input type="text" name="mailconnect" size="20" placeholder="Votre adresse mail" required>
               </td>
            </tr>

            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr> 
            <tr>
               <td align="right">
                  <label for="Nom">Mot de passe :</label>
               </td>
               <td>
                  <input type="password" name="passconnect" size="20" placeholder="Votre mot de passe" required>
               </td>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            </tr>
               <td></td>
               <td>
                  <button type="submit" name="formconnexion" class="Envoyer"> Se connecter </button>
               </td>
            </tr>

            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>            
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

         <p align="center"> Pas encore de compte ? Inscrivez vous <a href="inscription.php"> ici </a> ! </p>
      </form>

      

      <div class="block-bas">
          <h3 class="contact"> <a href="Contact_me.html"> Contactez-nous</a>  pour plus d'informations</h3>

         <h3 class="actu">Pour suivre notre actualité ==></h3>

         <nav class="menu-bas">
               
            <li class="info">
               <a href="#"> <img src="image\FB Logo.png"></a>
            </li>
            <li class="info">
               <a href="#"><img src="image\IT Logo.png"></a>   
            </li>
         </nav>
      </div>

   </body>
</html>