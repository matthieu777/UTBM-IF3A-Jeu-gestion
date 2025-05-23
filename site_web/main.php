
<!-- CODE -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Jeu des énergies !</title>
        <link rel="stylesheet" href="style/main.css">
    </head>
    <body>
        <?php session_start();
        include "function_for_bdd.php";
        $idPlayerrequete= executeSQLRequest("SELECT idJoueur FROM joueur WHERE pseudo = ? ",array($_SESSION['pseudo']));
        $idPlayer = $idPlayerrequete-> fetch();
        $idPlayer = $idPlayer[0]

        ?>



        <!-- Barre des boutons de déconnexion etc... -->

        <div class="nav-barre">
        <div class="nav-barre-gauche">
            <img  class = "logo_du_jeu_nav" src="textures/logo_energie.png">
        </div>
        <div class="nav-barre-centre">
            <h1 class="nav-barre-titre"><u> Industries de <?php echo $_SESSION['pseudo']?></u><h1>
        </div>
        <div class="nav-barre-droite">
            <div class="nav-barre-droite-gauche">
                 <button class="nav-barre-boutton" onclick="window.location.href='connexion_inscription/parametre_front.php'">
                    <span><img class = "nav-barre-boutton-logo" src="textures/logo-profil.png"></span>
                </button>
            </div>
            <div class="nav-barre-droite-droite">
            <form method="POST">
            <button class="nav-barre-boutton" name="deconnexion">
                    <span><img class = "nav-barre-boutton-logo" src="textures/logo-deconexion.png"></span>
                </button>
            </form>
            </div>
        </div>
        </div>


<?php

if (isset($_POST['deconnexion'])) {
  session_destroy();
  header('Location: accueil.php?reussi=deconnexion');
}
?>


        <div class="body-main">




        <div class="body-main-gauche">
            <?php
                echo '<iframe class="graphe" id="graph_iframe" name="graph_iframe" src="chart.php?idPlayer='.$idPlayer.'" ></iframe>';
            ?>
        <div class="body-main-gauche-bas">



        <!-- Display of the centrals/mines -->

        <?php


            $r = "SELECT numeroTour FROM map INNER JOIN joueur ON map.idPartie = joueur.numeroPartie WHERE joueur.idJoueur = ?";
            $tour = requestResultToArray(executeSQLRequest($r,array($idPlayer)))[0][0];

            // AFFICHAGE DES CENTRALE

            // Get the number of each type of powerplant in the db
            $arr = ["wind_turbine", "solar_panel", "dam", "oil_power_station", "nuclear_plant"];
            for ($i=0; $i < count($arr); $i++) {
                $r = "SELECT idStructure, nom, tourCreation FROM `structure` WHERE idProprietaire = ? AND type = ?;";
                $data = requestResultToArray(executeSQLRequest($r, array($idPlayer, $arr[$i])));



                echo '<div  class="'.$arr[$i].'">';

                echo '<div  class="box-mes-usine-gauche">';
                echo '<div  class="box-plus-mes-usine-gauche">';
                echo '<a href="buy_structure_front.php?type='.$arr[$i].'&playerid='.$idPlayer.'&tour='.$tour.'" target="misc_display_iframe"><img src="textures/plus.png" class="plus_pic"></a>';
                echo '</div> ';

                echo '<div  class="box-usine-mes-usine-gauche">';
                for ($j=0; $j < count($data); $j++) {

                    echo '<a href="central.php?type='.$arr[$i].'&id='.$data[$j][0].'&name='.$data[$j][1].'&datecrea='.$data[$j][2].'&tour='.$tour.'" target="misc_display_iframe"><img src="textures/'.$arr[$i].'.png" class="power_plant_pic"></a>';

                }
                echo '</div> ';

                echo '</div> ';
                echo '</div> ';

            }
        ?>

        <br>

              <?php
            // AFFICHAGE DES MINES

            $arr = ["iron_mine", "oil_mine", "uranium_mine"];
            for ($i=0; $i < count($arr); $i++) {
                $r = "SELECT idStructure, nom, tourCreation FROM `structure` WHERE idProprietaire = ? AND type = ?;";
                $data = requestResultToArray(executeSQLRequest($r, array($idPlayer, $arr[$i])));

                echo '<div class="'.$arr[$i].'">';

                echo '<div  class="box-mes-usine-gauche">';
                echo '<div  class="box-plus-mes-usine-gauche">';


                echo '<a href="buy_structure_front.php?type='.$arr[$i].'&playerid='.$idPlayer.'&tour='.$tour.'" target="misc_display_iframe"><img src="textures/plus.png" class="plus_pic"></a>';
                echo "</div>";

                echo '<div  class="box-usine-mes-usine-gauche">';
                for ($j=0; $j < count($data); $j++) {
                    echo '<a href="central.php?type='.$arr[$i].'&id='.$data[$j][0].'&name='.$data[$j][1].'&datecrea='.$data[$j][2].'&tour='.$tour.'" target="misc_display_iframe"><img src="textures/'.$arr[$i].'.png" class="power_plant_pic"></a>';
                }
                echo "</div>";


                echo "</div>";
                echo '</div> ';
            }
        ?>


    </div>

    </div>







<!-- partie à droit -->

    <div class="body-main-droite">

        <!-- Display of the button menu -->

        <div class="body-main-droite-box-boutton">

        <div class="barre_button_menu_gauche">
            <?php
                // DETAIL
                $button_names = ['dollar', 'electricity', 'iron', 'oil', 'uranium'];

                for ($i = 0; $i < count($button_names); $i++) {
                    echo '<a href="detail.php?type='.$button_names[$i].'&idPlayer='.$idPlayer.'&tour='.$tour.'" target="misc_display_iframe"><img src="textures/'.$button_names[$i].'.png" class="img_barre_menu"></a>';
                }

            ?>
        </div>

        <div class="barre_button_menu_droite">
            <!-- MARKET ET CONTRATS -->
            <?php
                echo '<a href="market_front.php?idPlayer='.$idPlayer.'" target="misc_display_iframe"><img src="textures/market.png" class="img_barre_menu_market"></a>';
                echo '<a href="contract_front.php?idPlayer='.$idPlayer.'" target="misc_display_iframe"><img src="textures/deal.png" class="img_barre_menu_contract"></a>';
            ?>
        </div>

        </div>



        <!-- Display of the subpage handling every miscellaneous displays -->

        <iframe class="page-info" src="" name="misc_display_iframe" id="misc_display_iframe" height=70% width=90%  style="float: right" scrolling=no></iframe>

    </div>



    </div>
      <iframe class="actualisation" id="actualisation_iframe" name="actualisation_iframe" src="actualisation.php" ></iframe>
    </body>
</html>
