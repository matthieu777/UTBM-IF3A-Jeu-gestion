<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>
            Détails
        </title>
        <link rel="stylesheet" href="style/detail.css">
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

            $type = $_GET["type"];
            $player = $_GET["idPlayer"];
        ?>

        <h1><u>Détail du gain
            <?php
                $name = ['dollar' => "d'argent", 'electricity' =>  "d'électricité", 'iron' =>  'de fer', 'oil' =>  'de pétrole', 'uranium' =>  "d'uranium"];
                echo "$name[$type]";
            ?>
            </u>
        </h1>

                <?php
                    $list = ['dollar' => 'numeroArgent', 'electricity' => 'nombreElec', 'iron' => 'nombreFer', 'oil' => 'nombrePetrole', 'uranium' => 'nombreUranium'];
                    $ajout_ressources = ['dollar' => 0, 'electricity' => 0, 'iron' => 0, 'oil' => 0, 'uranium' => 0];
                    $pertent_ressources = ['dollar' => 0, 'electricity' => 0, 'iron' => 0, 'oil' => 0, 'uranium' => 0];

                    $req = "SELECT ".$list[$type]." FROM joueur WHERE idJoueur = ?;";
                    $res = executeSQLRequest($req, array($player));
                    $ressources_actuel = $res->fetch();


                    //calcul des ressouces :


                    //recuperation des ressources
                    $valeurs_restant_map = requestResultToArray(executeSQLRequest("SELECT ferRestant AS iron , petroleRestant AS oil, uraniumRestant AS uranium FROM map WHERE idPartie = (SELECT numeroPartie FROM joueur WHERE idJoueur = ?)", array($player)));
                    $valeurs_production_joueur = requestResultToArray(executeSQLRequest("SELECT COALESCE(SUM(productionIron),0) AS iron, COALESCE(SUM(productionOil),0) AS oil, COALESCE(SUM(productionUranium),0) AS uranium FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idProprietaire = ?", array($player)));

                    $tab_equilibrage = ['electricity' => 'productionElec', 'iron' => 'productionIron', 'oil' => 'productionOil', 'uranium' => 'productionUranium'];

                    //teste puis ajout du fer
                    if($type == 'iron' or $type == 'oil' or $type == 'uranium'){
                      if($valeurs_restant_map[0][$type] >= $valeurs_production_joueur[0][$type]){
                         $req = executeSQLRequest("SELECT COALESCE(SUM( ".$tab_equilibrage[$type]." ),0) FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type where idProprietaire = ?", array($player));
                         $ajout_ressources[$type] = $req -> fetch();
                      }
                      else{
                        //permet que lorsque la map est vide de ressources de mettre quand meme le sous tableau pour eviter les erreurs
                        $ajout_ressources[$type] = array(0);
                      }
                    }


                    //recuperation de la liste des id de toutes structures du joueur
                    $liste_id_structure = requestResultToArray(executeSQLRequest("SELECT idStructure FROM structure WHERE idProprietaire = ?;", array($player)));
                    //parcours chaques structures une par une pour soustraire les cout de productions et ajouter l'electricite
                    for($i = 0; $i<count($liste_id_structure); $i++){

                      // recupere les ressources du joueur pour le comparer avec se qu'il va utililier
                      $valeurs_restant_joueur = requestResultToArray(executeSQLRequest("SELECT nombreFer AS fer , nombrePetrole AS petrole, nombreUranium AS uranium, numeroArgent AS dollar FROM joueur WHERE idJoueur = ?;", array($player)));
                      $valeurs_cout_production = requestResultToArray(executeSQLRequest("SELECT coutProductionIron AS fer , coutProductionOil AS petrole, coutProductionUranium AS uranium, coutProductionDollar AS dollar FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idProprietaire = (SELECT idJoueur FROM joueur WHERE idJoueur = ?) AND idStructure = ?", array($player, $liste_id_structure[$i][0])));

                      $tab_cout_production = ['iron' => 'coutProductionIron', 'oil' => 'coutProductionOil', 'uranium' => 'coutProductionUranium', 'dollar' => 'coutProductionDollar'];
                      if($valeurs_restant_joueur[0]["fer"] >= $valeurs_cout_production[0]["fer"] and $valeurs_restant_joueur[0]["petrole"] >= $valeurs_cout_production[0]["petrole"] and $valeurs_restant_joueur[0]["uranium"] >= $valeurs_cout_production[0]["uranium"] and $valeurs_restant_joueur[0]["dollar"] >= $valeurs_cout_production[0]["dollar"]){
                        //enleve a joueur les couts de productions de la centrale
                        if($type == 'electricity'){
                          $donnees = requestResultToArray(executeSQLRequest("Select type, tourCreation From structure Where idStructure = ?",array($liste_id_structure[$i][0])));
                          $tour = $_GET["tour"];
                          $ajout_ressources[$type] +=  elecProdGaussian($donnees[0][0], $tour, $donnees[0][1]);
                        }
                        elseif ($type == 'dollar') {

                          $res = executeSQLRequest("SELECT nombreElec FROM joueur WHERE idJoueur = ?;", array($player));
                          $ajout_ressources['dollar'] = $res->fetch();

                        }
                        else{

                          $req = executeSQLRequest("SELECT ".$tab_cout_production[$type]." FROM equilibrage INNER JOIN structure on equilibrage.typeStructure = structure.type WHERE idStructure = ?", array($liste_id_structure[$i][0]));
                          $req = $req -> fetch();

                          $pertent_ressources[$type] = $pertent_ressources[$type] + $req[$tab_cout_production[$type]];
                        }
                      }
                    }
                    if($type == 'dollar' and $ajout_ressources['dollar'] == 0){
                      $ajout_ressources['dollar'] = array( 0 => 0);
                    }

                ?>
             <ol class="ensemble_detail">
            <li>Nombre actuel <?php echo $name[$type]; ?> : <?php echo $ressources_actuel[0];?></li>
            <ol>
                <li>Mine/Centrales : + <?php if($type == 'electricity'){echo round($ajout_ressources[$type],2);} else{echo $ajout_ressources[$type][0];} ?></li>
                <li>Mine/Centrales : - <?php echo $pertent_ressources[$type];//$pertent_ressources[$type]; ?></li>
            </ol>
            <li>Total au prochain mois : <?php if($type == 'electricity'){
              echo round(floatval($ressources_actuel[0]) + floatval($ajout_ressources[$type]) + floatval($pertent_ressources[$type]),2);
            }
            else{
               echo intval($ressources_actuel[0]) + intval($ajout_ressources[$type][0]) - intval($pertent_ressources[$type]);
             }?></li>

        </ol>
    </body>
</html>
