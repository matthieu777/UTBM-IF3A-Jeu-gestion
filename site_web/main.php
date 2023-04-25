<!-- FUNCTIONS (you can't see the code its in php :-) )-->

<!-- CSS related functions -->
<?php
    function writeClickableImageCSS(string $class, int $height, int $width)
    {
        echo '<style>
                .'.$class.'{
                    height: '.$height.'px;
                    width: '.$width.'px;
                    object-fit: contain;
                }
            </style>';
    }

    function writeButtonMenuCSS(string $class, int $left, int $top){
        echo '<style>
                .'.$class.'{
                    left: '.$left.'%;
                    top: '.$top.'%
                }
            </style>';
    }

    function writeIframeCSS(string $id, int $right, int $top){
        echo '<style>
                #'.$id.'{
                    right: '.$right.'%;
                    top: '.$top.'%
                }
            </style>';
    }
?>

<!-- CODE -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Jeu des énergies !</title>
        <link rel="stylesheet" href="style/main.css">
    </head>
    <body>
        <?php session_start(); ?>
        <!-- Write CSS -->
        <?php
            writeClickableImageCSS("info_menu_pic", 125, 125);
            writeClickableImageCSS("menu_pic", 200, 200);
            writeClickableImageCSS("power_plant_pic", 60, 60);
            writeClickableImageCSS("mines_pic", 65, 65);
            writeClickableImageCSS("plus_pic", 45, 45);

            writeButtonMenuCSS("info_button_menu",27,1);
            writeButtonMenuCSS("button_menu",70,0);

            writeIframeCSS("misc_display_iframe", 1, 33);
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
                <button class="nav-barre-boutton" onclick="window.location.href='inscription.php'">
                    <span><img class = "nav-barre-boutton-logo" src="textures/logo-profil.png"></span>
                </button>
            </div>
            <div class="nav-barre-droite-droite">
            <button class="nav-barre-boutton" onclick="window.location.href='acceuil.php'">
                    <span><img class = "nav-barre-boutton-logo" src="textures/logo-deconexion.png"></span>
                </button>
            </div>
        </div>
        </div>





        <div class="body-main">




        <div class="body-main-gauche">

            <iframe class="graphe" id="graph_iframe" name="graph_iframe" src="chart.php" ></iframe>



        <div class="body-main-gauche-bas">



        <!-- Display of the centrals/mines -->

        <?php
            include("function_for_bdd.php");

            // Get the number of each type of powerplant in the db
            $arr = ["wind_turbine", "solar_panel", "dam", "oil_power_station", "nuclear_plant"];
            for ($i=0; $i < count($arr); $i++) {
                $r = "SELECT idStructure, nom, tourCreation FROM `structure` WHERE idProprietaire = 1 AND type = ?;";
                $data = requestResultToArray(executeSQLRequest($r, array($arr[$i])));

                echo '<div class="'.$arr[$i].'">';

                echo '<a href="buy_structure_front.php?type='.$arr[$i].'&playerid=1" target="misc_display_iframe"><img src="textures/plus.png" class="plus_pic"></a>';

                for ($j=0; $j < count($data); $j++) {
                    echo '<a href="central.php?type='.$arr[$i].'&id='.$data[$j][0].'&name='.$data[$j][1].'&datecrea='.$data[$j][2].'" target="misc_display_iframe"><img src="textures/'.$arr[$i].'.png" class="power_plant_pic"></a>';
                }
                echo "</div>";
            }
        ?>


        <br>

        <?php
            $arr = ["iron", "oil", "uranium"];
            for ($i=0; $i < count($arr); $i++) {
                $r = "SELECT idStructure, nom, tourCreation FROM `structure` WHERE idProprietaire = 1 AND type = ?;";
                $data = requestResultToArray(executeSQLRequest($r, array($arr[$i])));

                echo '<div class="'.$arr[$i].'">';

                echo '<a href="buy_structure_front.php?type='.$arr[$i].'&playerid=1" target="misc_display_iframe"><img src="textures/plus.png" class="plus_pic"></a>';

                for ($j=0; $j < count($data); $j++) {
                    echo '<a href="central.php?type='.$arr[$i].'&id='.$data[$j][0].'&name='.$data[$j][1].'&datecrea='.$data[$j][2].'" target="misc_display_iframe"><img src="textures/'.$arr[$i].'.png" class="power_plant_pic"></a>';
                }
                echo "</div>";
            }
        ?>


    </div>

    </div>







<!-- partie à droit -->

    <div class="body-main-droite">

        <!-- Display of the button menu -->

        <div class="body-main-droite-box-boutton">

        <div class="info_button_menu">
            <?php
                $button_names = ['dollar', 'electricity', 'iron', 'oil', 'uranium'];

                for ($i = 0; $i < count($button_names); $i++) {
                    echo '<a href="detail.php?type='.$button_names[$i].'" target="misc_display_iframe"><img src="textures/'.$button_names[$i].'.png" class="info_menu_pic"></a>';
                }

            ?>
        </div>

        <div class="button_menu">
            <a href="market.php" target="misc_display_iframe"><img src="textures/market.png" class="menu_pic"></a>
            <a href="contract.php" target="misc_display_iframe"><img src="textures/deal.png" class="menu_pic"></a>
        </div>

        </div>



        <!-- Display of the subpage handling every miscellaneous displays -->

        <iframe class="page-info" src="" name="misc_display_iframe" id="misc_display_iframe" height=70% width=90%  style="float: right" scrolling=no></iframe>

    </div>



    </div>
      <iframe class="actualisation" id="actualisation_iframe" name="actualisation_iframe" src="actualisation.php" ></iframe>
    </body>
</html>
