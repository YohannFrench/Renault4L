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
if (isset($_GET['id']) and $_GET['id']>0)
{
   $getid = intval($_GET['id']); // obtient l'ID 
   $requser = $conn->prepare("SELECT * FROM membres WHERE id = ?"); //prepare la requête
   $requser->execute(array($getid));
   $userinfo = $requser->fetch(); //Va chercher les données (pseudo,mail,pass,ID,etc...)
?>


<!DOCTYPE html>
<html>
   <head>
   	<title>Votre espace membre</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="profil2.css">

   </head>

   <body>

      <div class="info_profil" align="center">
         <h2>Bienvenue <?php echo $userinfo['pseudo'];?> </h2>
         <h3> Numéro de compte : <?php echo $userinfo['id'];?></h3>

         <ul class="sous_info_profil">
            <br><br>
            Pseudo = <?php echo $userinfo['pseudo'];?>
            <br><br>
            Mail = <?php echo $userinfo['email'];?>
            <br><br>
         </ul>
         <?php
         if (isset($_SESSION['id']) and $userinfo['id'] == $_SESSION['id'])
         {
         ?>
         <a href="edition_profil.php"> Editer mon profil</a> &nbsp; &nbsp; <!--Ajout d'espace-->
         <a href="deconnexion.php"> Se déconnecter</a>
         <?php
         }
         ?>
      </div>

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
<?php
}
?>
</html>