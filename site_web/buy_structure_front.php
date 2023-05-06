<!-- SQL related functions -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Acheter des Structures</title>
        <link rel="stylesheet" href="style/buy_structure.css">
    </head>
    <body>
        <?php
            include("function_for_bdd.php");
            $type = $_GET["type"];
            $playerId = $_GET["playerid"];
            $tour = $_GET["tour"];


            $arr = ["wind_turbine" => "une éolienne",
                    "oil_power_station" => "une centrale à pétrole",
                    "nuclear_plant" => "une centrale nucléaire",
                    "dam" => "un barrage hydroélectrique",
                    "solar_panel" => "un panneau solaire",
                    "iron_mine" => "une mine de fer",
                    "oil_mine" => "une mine de pétrole",
                    "uranium_mine" => "une mine d'uranium"
                ];
            echo "<h1><u>Acheter ".$arr[$type]."</u></h1>";

            $prices = ['dollar' => 0, 'iron' => 0, 'oil' => 0, 'uranium' => 0];
            $a = ['dollar', 'iron', 'oil', 'uranium'];
            $r = "SELECT coutAchatDollar, coutAchatIron, coutAchatOil, coutAchatUranium FROM `equilibrage` WHERE typeStructure = ?";
            $res = requestResultToArray(executeSQLRequest($r, array($type)));
            for ($i=0; $i < count($prices); $i++) {
                $prices[$a[$i]] = $res[0][$i];
            }

            echo "<p class='prix'>Prix :</p>";

            $i = 0;
            foreach ($prices as $key => $value) {
                echo '<div class="ensemble">
                <div class =box-img><img class=image src="textures/'.$key.'.png" ></div><p >'.$value.'</p>
                </div>';



                $i++;
            }

            $r = "SELECT numeroArgent, nombreFer, nombrePetrole, nombreUranium FROM joueur WHERE idJoueur = ?";
            $ressources = requestResultToArray(executeSQLRequest($r, array($playerId)));
            if ($ressources[0][0] >= $prices['dollar'] and $ressources[0][1] >= $prices['iron'] and $ressources[0][2] >= $prices['oil'] and $ressources[0][3] >= $prices['uranium']) {
                echo '<button class = boutton-acheter type="button" name="button"><a class = texte-boutton-acheter type="button" href="buy_structure_back.php?type='.$type.'&playerid='.$playerId.'&tour='.$tour.'&price_dollar='.$prices['dollar'].'&price_iron='.$prices['iron'].'&price_oil='.$prices['oil'].'&price_uranium='.$prices['uranium'].'">Acheter</a></button>';
            } else {
                echo "<p class=erreur>Vous n'avez pas assez de ressources pour acheter ce bâtiment.</p>";
            }
        ?>

    </body>
</html>
