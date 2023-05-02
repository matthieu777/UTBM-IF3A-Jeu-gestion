<!DOCTYPE html>

<?php
header("Refresh: 1");
session_start();
?>

<html>
  <head>
  </head>
  <body>
    <?php
    include("function_for_bdd.php");

    function elecProdGaussian(string $type, int $tour, int $tourCrea){
        $r = "SELECT coutAchatDollar, coutAchatIron, productionElec FROM equilibrage WHERE typeStructure = ?;";
        $res = requestResultToArray(executeSQLRequest($r, array($type)));

        $a = $res[0][0];
        $b = $res[0][1];
        $m = $res[0][2];

        //f(x) = m*e^(-((1)/(a))(x-b)^(2))+c
        return $m * exp(-((($tour - $tourCrea) - $b)**2 / ($a * 25)));
    }

    // Enregistrons les informations de date dans des variables
    $seconde = date("s");
    $pseudo = $_SESSION['pseudo'];
    echo '<br><br><br><br>';
    echo $seconde;
    if($seconde == 59 or $seconde == 19 or $seconde == 39)
    { #pour s'assurer qu'il n'y ai pas plusieurs actualisation la meme seconde
      $req = executeSQLRequest("SELECT numeroTour FROM map INNER JOIN joueur ON map.idPartie = joueur.numeroPartie WHERE pseudo = ?",array($pseudo));
      $tour = $req->fetch();
      $tour = $tour["numeroTour"];
      sleep(1);
      $tour = $tour + 1;
      //executeSQLRequest("INSERT INTO `contrat` (`idVendeur`, `ressource1`, `valeur1`, `ressource2`, `valeur2`,`periode`,`duree`) VALUES (?,?,?,?,?,1,1); ",array());

      //recuperation des ressources
      $valeurs_restant_map = requestResultToArray(executeSQLRequest("SELECT ferRestant AS fer , petroleRestant AS petrole, uraniumRestant AS uranium FROM map WHERE idPartie = (SELECT numeroPartie FROM joueur WHERE pseudo = ?)", array($pseudo)));
      $valeurs_production_joueur = requestResultToArray(executeSQLRequest("SELECT SUM(productionIron) AS fer, SUM(productionOil) AS petrole, SUM(productionUranium) AS uranium FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idProprietaire = (SELECT idJoueur FROM joueur WHERE pseudo = ?)", array($pseudo)));

      //teste puis ajout du fer
      if($valeurs_restant_map[0]["fer"] >= $valeurs_production_joueur[0]["fer"]){
        executeSQLRequest("UPDATE joueur SET nombreFer = nombreFer + (SELECT SUM(productionIron) FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type ) where idJoueur = (SELECT idJoueur FROM joueur WHERE pseudo = ?)", array($pseudo));
        executeSQLRequest("UPDATE map SET ferRestant = ferRestant - (SELECT SUM(ProductionIron) FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idProprietaire = (SELECT idJoueur FROM joueur WHERE pseudo = ?)) where idPartie = (SELECT numeroPartie FROM joueur WHERE pseudo = ?)",array($pseudo, $pseudo));
      }

      //teste puis ajout du petrole
      if($valeurs_restant_map[0]["petrole"] >= $valeurs_production_joueur[0]["petrole"]){
        executeSQLRequest("UPDATE joueur SET nombrePetrole = nombrePetrole + (SELECT SUM(productionOil) FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type ) where idJoueur = (SELECT idJoueur FROM joueur WHERE pseudo = ?)", array($pseudo));
        executeSQLRequest("UPDATE map SET petroleRestant = petroleRestant - (SELECT SUM(ProductionOil) FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idProprietaire = (SELECT idJoueur FROM joueur WHERE pseudo = ?)) where idPartie = (SELECT numeroPartie FROM joueur WHERE pseudo = ?)",array($pseudo, $pseudo));
      }

      //teste puis ajout du uranium
      if($valeurs_restant_map[0]["uranium"] >= $valeurs_production_joueur[0]["uranium"]){
        executeSQLRequest("UPDATE joueur SET nombreUranium = nombreUranium + (SELECT SUM(productionUranium) FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type ) where idJoueur = (SELECT idJoueur FROM joueur WHERE pseudo = ?)", array($pseudo));
        executeSQLRequest("UPDATE map SET uraniumRestant = uraniumRestant - (SELECT SUM(productionUranium) FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idProprietaire = (SELECT idJoueur FROM joueur WHERE pseudo = ?)) where idPartie = (SELECT numeroPartie FROM joueur WHERE pseudo = ?)",array($pseudo, $pseudo));
      }

      //recuperation de la liste des id de toutes structures du joueur
      $liste_id_structure = requestResultToArray(executeSQLRequest("SELECT idStructure FROM structure WHERE idProprietaire = (SELECT idJoueur FROM joueur WHERE pseudo = ?);", array($pseudo)));
      //parcours chaques structures une par une pour soustraire les cout de productions et ajouter l'electricite
      for($i = 0; $i<count($liste_id_structure); $i++){

        // recupere les ressources du joueur pour le comparer avec se qu'il va utililier
        $valeurs_restant_joueur = requestResultToArray(executeSQLRequest("SELECT nombreFer AS fer , nombrePetrole AS petrole, nombreUranium AS uranium, numeroArgent AS dollar FROM joueur WHERE pseudo = ?;", array($pseudo)));
        $valeurs_cout_production = requestResultToArray(executeSQLRequest("SELECT coutProductionIron AS fer , coutProductionOil AS petrole, coutProductionUranium AS uranium, coutProductionDollar AS dollar FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idProprietaire = (SELECT idJoueur FROM joueur WHERE pseudo = ?) AND idStructure = ?", array($pseudo, $liste_id_structure[$i][0])));

        if($valeurs_restant_joueur[0]["fer"] >= $valeurs_cout_production[0]["fer"] and $valeurs_restant_joueur[0]["petrole"] >= $valeurs_cout_production[0]["petrole"] and $valeurs_restant_joueur[0]["uranium"] >= $valeurs_cout_production[0]["uranium"] and $valeurs_restant_joueur[0]["dollar"] >= $valeurs_cout_production[0]["dollar"]){
          //enleve a joueur les couts de productions de la centrale
          executeSQLRequest("UPDATE joueur SET nombreFer = nombreFer - (SELECT coutProductionIron FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idStructure = ?) WHERE pseudo = ?", array($liste_id_structure[$i][0], $pseudo));
          executeSQLRequest("UPDATE joueur SET nombrePetrole = nombrePetrole - (SELECT coutProductionOil FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idStructure = ?) WHERE pseudo = ?", array($liste_id_structure[$i][0], $pseudo));
          executeSQLRequest("UPDATE joueur SET nombreUranium = nombreUranium - (SELECT coutProductionUranium FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idStructure = ?) WHERE pseudo = ?", array($liste_id_structure[$i][0], $pseudo));
          executeSQLRequest("UPDATE joueur SET numeroArgent = numeroArgent - (SELECT coutProductionDollar FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idStructure = ?) WHERE pseudo = ?", array($liste_id_structure[$i][0], $pseudo));

          //la production electrique n'est pas stoqué elle est directement vendu en dollar
          $donnees = requestResultToArray(executeSQLRequest("Select type, tourCreation From structure Where idStructure = ?",array($liste_id_structure[$i][0])));
          $production = elecProdGaussian($donnees[0]["type"], $tour, $donnees[0]["tourCreation"]);

          executeSQLRequest("UPDATE joueur SET numeroArgent = numeroArgent + ?",array(elecProdGaussian($donnees[0]["type"], $tour, $donnees[0]["tourCreation"])));
          executeSQLRequest("UPDATE joueur SET nombreElec = nombreElec + ?",array(elecProdGaussian($donnees[0]["type"], $tour, $donnees[0]["tourCreation"])));
        }
      }
      //gestion des graph
      $productionElec = executeSQLRequest("SELECT nombreElec FROM Joueur WHERE pseudo = ?", array($pseudo));
      $productionElec = $productionElec -> fetch();
      echo var_dump($productionElec["nombreElec"]);
      executeSQLRequest("INSERT INTO graphoffre (tour, valeur, idJoueur) VALUES (?, ?, (SELECT idJoueur FROM joueur WHERE pseudo = ?))", array($tour, $productionElec["nombreElec"], $pseudo));

      //recuperation du tour actuel
      $req = executeSQLRequest("SELECT numeroTour FROM map INNER JOIN joueur ON map.idPartie = joueur.numeroPartie WHERE pseudo = ?",array($pseudo));
      $tour_actuel = $req->fetch();
      $tour_actuel = $tour_actuel["numeroTour"];
      //si le tour n'a pas encore changé, se sera cette page qui s'en chargera
      if($tour - 1 == $tour_actuel){
        //tour + 1
        executeSQLRequest("UPDATE map SET numeroTour = numeroTour + 1 WHERE idPartie = (SELECT numeroPartie FROM joueur WHERE pseudo = ?)", array($pseudo ));
        // la page choisi est theoriquement la plus en avance ( d'au max 1s) on va donc attendre que tt les autres pages incremente leur graph pour faire le graph demande
        sleep(1);
        //la page choisi pour ajouter le tour s'occupe egalement de calculer le graph de demande
        //si c le premier tour, la demande et initialisé a 0
        echo "tour ", $tour;
        if($tour == 1){
          executeSQLRequest("INSERT INTO graphdemande (tour, valeur, partie) VALUES (?, ?, (SELECT numeroPartie FROM joueur WHERE pseudo = ?))", array($tour, 0, $pseudo));
        }
        else{
          $liste_production = requestResultToArray(executeSQLRequest("SELECT valeur FROM graphoffre INNER JOIN joueur ON graphoffre.idJoueur = joueur.idJoueur INNER JOIN map ON joueur.numeroPartie = map.idPartie WHERE numeroPartie = (SELECT numeroPartie FROM joueur WHERE pseudo = ?) AND tour = ? ", array($pseudo , $tour)));
          //calcul moyenne
          $somme = 0;
          for($i = 0; $i<count($liste_production); $i++){
            echo var_dump($liste_production[$i]["valeur"]);
            $somme = $somme + $liste_production[$i]["valeur"];
          }
          $moyenne = $somme / count($liste_production);
          $demande_elec = executeSQLRequest("SELECT valeur FROM graphdemande WHERE tour = ? - 1 and partie = (SELECT numeroPartie FROM joueur WHERE pseudo = ?);",array($tour, $pseudo));
          echo '<br><br>',var_dump($demande_elec);
          $demande_elec = $demande_elec -> fetch();
          echo var_dump($demande_elec);

          $demande_elec = $demande_elec["valeur"] + rand(0, ($moyenne) - $demande_elec["valeur"]);
          executeSQLRequest("INSERT INTO graphdemande (tour, valeur, partie) VALUES (?, ?, (SELECT numeroPartie FROM joueur WHERE pseudo = ?))", array($tour, $demande_elec, $pseudo));
        }
      }

      executeSQLRequest("UPDATE joueur SET nombreElec = 0 WHERE joueur.idJoueur = ?; ", array($pseudo));

      echo '
      <script type="text/javascript">
         parent.window.location.reload(true);
      </script>
      ';

    }
    ?>
  </body>
</html>
