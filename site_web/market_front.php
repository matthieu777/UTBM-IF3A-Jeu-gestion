<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Market Place</title>
        <link rel="stylesheet" href="style/market.css">

    </head>

    <body>
        <h1><u>Market Place</u></h1>
        <div class="box-marcher-contract">
        <?php
            include("function_for_bdd.php");

            $idPlayer = $_GET["idPlayer"];

            $id_contrat = requestResultToArray(executeSQLRequest("SELECT idContrat FROM `contrat`", array()));

            //parcours autant de fois qu'il y a de contrat pour tous les afficher
            for ($i = 0; $i < count($id_contrat); $i++) {
                $donnees = executeSQLRequest("SELECT idVendeur, pseudo , ressource1, valeur1, ressource2, valeur2 FROM contrat INNER JOIN joueur ON idVendeur = joueur.idJoueur WHERE idContrat = ?", array($id_contrat[$i][0]));
                $res = requestResultToArray($donnees);
                if (count($res) != 0){
                    //affichage de la ligne de contrat
                    echo '<button class = textemarket name = '.$i.' type="button_market" OnClick="GoToBack('.$id_contrat[$i][0].','.$idPlayer.')"> '.$res[0][1].' veut vendre '.$res[0][3].' <img src="textures/'.$res[0][2].'.png"> en echange de '.$res[0][5].' <img src="textures/'.$res[0][4].'.png"></button>';
                }
            }
        ?>
        </div>

        <?php // si il n'y a pas de contrat
          if(count($id_contrat) == 0){
            echo "<h3>Il n'y a aucun contrat pour le moment.</h3>";
          }
        ?>

    </body>
</html>
<script type="text/javascript">
    function GoToBack(idContrat, idPlayer){
        window.location = "market_back.php?idContrat=" + idContrat + "&idPlayer=" + idPlayer;
    }
</script>

