<!-- SQL related functions -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Acheter des Structures</title>
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
            echo "<h1>Acheter ".$arr[$type]."</h1>";

            $prices = ['dollar' => 0, 'iron' => 0, 'oil' => 0, 'uranium' => 0];
            $a = ['dollar', 'iron', 'oil', 'uranium'];
            $r = "SELECT coutAchatDollar, coutAchatIron, coutAchatOil, coutAchatUranium FROM `equilibrage` WHERE typeStructure = ?";
            $res = requestResultToArray(executeSQLRequest($r, array($type)));
            for ($i=0; $i < count($prices); $i++) {
                $prices[$a[$i]] = $res[0][$i];
            }

            echo "<p>Prix :</p>";

            $i = 0;
            foreach ($prices as $key => $value) {
                echo '<div class="'.$key.'">
                <img src="textures/'.$key.'.png" style="width:70px; height:70px; object-fit: contain"><p style="position: absolute; right: 0%; top: 10%">'.$value.'</p>
                </div>';

                echo '<style>
                        .'.$key.'{
                            width: 13%;
                            position: absolute;
                            left: 0%;
                            top: '.($i*17+2*16).'%;
                        }
                    </style>';

                $i++;
            }

            echo '<button type="button" name="button"><a href="buy_structure_back.php?type='.$type.'&playerid='.$playerId.'&tour='.$tour.'&price_dollar='.$prices['dollar'].'&price_iron='.$prices['iron'].'"><img src="textures/acheter.png"></a></button>';
        ?>

    </body>
</html>
