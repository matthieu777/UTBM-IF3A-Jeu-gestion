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

        $nbr_contrat = executeSQLRequest("SELECT COUNT(*) FROM `contrat`", array());
        $nbr_contrat = $nbr_contrat['COUNT(*)'];

        for ($i=1; $i < $nbr_contrat +1 ; $i++) {
            $donnees = executeSQLRequest("SELECT idVendeur, speudo , ressource1, valeur1, ressource2, valeur2 FROM contrat INNER JOIN joueur ON idVendeur = joueur.idJoueur WHERE idContrat = $i", array());
            echo $donnees['speudo'], ' veut vendre ', $donnees['valeur1'],' ', $donnees['ressource1'], ' en echange de ', $donnees['valeur2'],' ', $donnees['ressource2']; ?><br><?php
          }?>

      </p>

        <h3>Il n'y a aucun contrat pour le moment.</h3>
    </body>
</html>
