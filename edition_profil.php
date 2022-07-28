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


<?php
if (isset($_SESSION['id']))
{
     $requser= $conn->prepare("SELECT * FROM membres WHERE id = ?");
     $requser->execute(array($_SESSION['id']));
     $user = $requser->fetch();

     if (isset($_POST['newpseudo']) and !empty($_POST['newpseudo']) and $_POST['newpseudo'] != $user['pseudo'])
     {
         $newpseudo = htmlspecialchars($_POST['newpseudo']);
         $insertpseudo = $conn -> prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
         $insertpseudo-> execute(array($newpseudo,$_SESSION['id']));
         header("Location: profil.php?id=".$_SESSION['id']);
     }

     if (isset($_POST['newmail']) and !empty($_POST['newmail']) and $_POST['newmail'] != $user['email'])
     {
         $newmail = htmlspecialchars($_POST['newmail']);
         $insertmail = $conn -> prepare("UPDATE membres SET email = ? WHERE id = ?");
         $insertmail-> execute(array($newmail,$_SESSION['id']));
         header("Location: profil.php?id=".$_SESSION['id']);
     }

     if (isset($_POST['newpass1']) and !empty($_POST['newpass1']) and isset($_POST['newpass2']) and !empty($_POST['newpass2'])) 
     {
         $newpass1 = sha1($_POST['newpass1']);
         $newpass2 = sha1($_POST['newpass2']);

            $insertnewpass = $conn->prepare("UPDATE membres SET pass = ? WHERE id = ?");
            $insertnewpass->execute(array($newpass1,$_SESSION['id']));
            header("Location: profil.php?id=".$_SESSION['id']);
         
     }
     if (isset($_POST['newpseudo']) and $_POST['newpseudo'] == $user['pseudo'])
     {
         header("Location: profil.php?id=".$_SESSION['id']);
     }
?>


<!DOCTYPE html>
<html>
   <head>
   	<title>Edition du profil</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="profil.css">

   </head>

   <body>

      <div class="info_profil" align="center">
        <br><br>
         <h2> Edition de mon profil</h2>
         <br><br><br><br>
         <form  onSubmit="return verify(this.newpass1, this.newpass2)" method="POST" action="">
            <table>
               <tr>
                  <td align="right">
                     <label>Pseudo :</label>
                  </td>
                  <td>
                     <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo'] ?>"> 
                  </td>
               </tr>
               <tr></tr>
               <tr></tr>
               <tr></tr>
               <tr>
                  <td align="right">
                     <label>Adresse mail :</label>
                  </td>
                  <td>
                     <input type="text" name="newmail" placeholder="Adresse mail" value="<?php echo $user['email'] ?>" >
                  </td> 
               </tr>
               <tr></tr>
               <tr></tr>
               <tr></tr>
               <tr>
                  <td align="right">
                     <label>Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" name="newpass1" placeholder="Mot de passe" >
                  </td> 
               </tr>
               <tr></tr>
               <tr></tr>
               <tr></tr>
               <tr>
                  <td align="right">
                     <label>Confirmez votre mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" name="newpass2" placeholder="Confirmez le mot de passe" >
                  </td>
               </tr>
               <tr></tr>
               <tr></tr>
               <tr></tr>
               <tr>
                  <td></td>
                  <td>
                     <input type="submit" value="Mettre à jour mon profil"> 
                  </td>
               </tr>
               <tr></tr>
               <tr></tr>
               <tr></tr>
               <tr>
                  <td></td>
                  <td class="erreur" align="right">
                  <?php
                     if (isset($erreur))
                     {
                        echo $erreur;
                     }
                  ?>
                  </td>
               </tr>
            </table>
         </form>     
      </div>

   </body>
<?php
}
else
{
   header('Location: connexion.php');
}
?>
</html>