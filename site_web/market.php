<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Market Place</title>
    </head>

    <body>
        <h1>Market Place</h1>
        <p>
        <?php
        include("function_for_bdd.php");

        $nbr_contrat = requestResultToArray(executeSQLRequest("SELECT ? FROM `contrat`", array('COUNT(*)')));
        $nbr_contrat = count($nbr_contrat);
        //parcours au temps de fois qu'il y ai de contrat pour tous les afficher
        for ($i=1; $i < $nbr_contrat +1 ; $i++) {
            $donnees = executeSQLRequest("SELECT idVendeur, pseudo , ressource1, valeur1, ressource2, valeur2 FROM contrat INNER JOIN joueur ON idVendeur = joueur.idJoueur WHERE idContrat = $i", array());
            $donnees = $donnees->fetch();
            //affichage de la ligne de contrat
            echo $donnees['pseudo'], ' veut vendre ', $donnees['valeur1'],' ', $donnees['ressource1'], ' en echange de ', $donnees['valeur2'],' ', $donnees['ressource2']; ?><br><?php
          }?>

      </p>
      <?php // si il n'y a pas de contrat
      if($nbr_contrat == 0){
        ?>
        <h3>Il n'y a aucun contrat pour le moment.</h3><?php
      }?>
    </body>
</html>
