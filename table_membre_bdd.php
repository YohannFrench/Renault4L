<?php
  //Connexion à la base BDD:
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'compte_4l';

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
?>
<html>
  <head>
    <title> Tableau des membres</title>
    <meta charset="utf-8">
    <style> /*CSS*/
      h1 {text-align: center;}
      table {border-collapse: collapse; width: 100%;}
      thead {border: 1px solid black;text-align: center; font-weight: bold; background:#BBBBBB;}
      td {border: 1px solid black;padding: 8px;}
    </style>
    <?php
      //Récupération des données depuis la bdd->compte 4l dans table "membre"
        $requete = "SELECT * FROM membre"; //Sélectionner tous de "membre"
        $answer = $conn->query($requete); // Prend les données de "membre"
        $array_info = ['id','Pseudo','Mot de passe','Mail','Date d\'inscription']; //Bandeau grisé
    ?>
  </head>
  <body>
    <h1>Tableau des membres</h1>
    <?php
      echo '<table>
              <thead> 
                <tr>';
                for ($i=0;$i<5;$i++)
                  {
                    echo"<td>$array_info[$i]</td>";
                  }
      echo '    </tr>
              </thead>
              <tbody>';
                while ($donnees = $answer->fetch()) // tant que tu peux aller chercher les données faire :
                  {
                    echo '<tr>';
                    for ($i=0;$i<5;$i++)
                      {
                        echo"<td> $donnees[$i]</td>";
                      }
                    echo '</tr>';
                  }
      echo '  </tbody>
            </table>';
    ?>
    <br><br>
    <!--<form action='webmaster_total.php' method:'post'>
      <input type='submit' value='Voir plus'/>
    </form>-->
  </body>
</html>

