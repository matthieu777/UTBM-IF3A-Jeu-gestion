<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Market Place</title>
        <style>
          img {
            width : 50px;
            height : 50px;
          }
        </style>
    </head>

    <body>
        <h1>Market Place</h1>
        <p>
        <?php
            include("function_for_bdd.php");

            $id_contrat = requestResultToArray(executeSQLRequest("SELECT idContrat FROM `contrat`", array()));

            //parcours autant de fois qu'il y a de contrat pour tous les afficher
            for ($i = 0; $i < count($id_contrat); $i++) {
                $donnees = executeSQLRequest("SELECT idVendeur, pseudo , ressource1, valeur1, ressource2, valeur2 FROM contrat INNER JOIN joueur ON idVendeur = joueur.idJoueur WHERE idContrat = ?", array($id_contrat[$i][0]));
                $res = requestResultToArray($donnees);
                if (count($res) != 0){
                    //affichage de la ligne de contrat
                    echo '<button name = '.$i.' type="button_market"> '.$res[0][1].' veut vendre '.$res[0][3].' <img src="textures/'.$res[0][2].'.png"> en echange de '.$res[0][5].' <img src="textures/'.$res[0][4].'.png">
                    </button>';
                }
            }
        ?>
        </p>

        <?php // si il n'y a pas de contrat
          if(count($id_contrat) == 0){
            echo "<h3>Il n'y a aucun contrat pour le moment.</h3>";
          }
        ?>

    </body>
</html>
