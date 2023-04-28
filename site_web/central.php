<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Détail des centrales</title>
    </head>
    <body>
        <?php
            // VARIABLE / FONCTION
            include("function_for_bdd.php");

            function elecProdGaussian(string $type, int $productionElec, int $tour, int $tourCrea){
                $r = "SELECT coutAchatDollar, coutAchatIron FROM equilibrage WHERE typeStructure = ?;";
                $res = requestResultToArray(executeSQLRequest($r, array($type)));

                $m = $productionElec;
                $a = $res[0][0];
                $b = $res[0][1];

                //f(x) = m*e^(-((1)/(a))(x-b)^(2))+c
                return $m * exp(-((($tour - $tourCrea) - $b)**2 / ($a * 25)));
            }

            $type = $_GET["type"];
            $name = $_GET["name"];
            $id = $_GET['id'];
            $datecrea = $_GET["datecrea"];
            $tour = $_GET["tour"];

            $random_sentence_pplt = [
                "wind_turbine" => [
                    '"Le vent souffle sur les plaines de la Bretagne Armoricaine."',
                    '"Take me to the magic of the moment, on a glory night, where the children of tomorrow dream away in the wind of change."',
                    '"Quatre vents sur passé, mes rêves envolés."'
                ],
                "oil_power_station" => [
                    '"Bienvenue, Harry Stamper."'
                ],
                "nuclear_plant" => [
                    '"On dit nuculaire !"'
                ],
                "dam" => [
                    '"I saw this big structure retaining water and was like... dam."'
                ],
                "solar_panel" => [
                    '"The Sun"',
                    'Au soleil, m'."'".'exposer un peu plus au soleil.'
                ]
            ];

            $arr = ["wind_turbine" => "Eolienne",
                    "oil_power_station" => "Centrale à pétrole",
                    "nuclear_plant" => "Centrale nucléaire",
                    "dam" => "Barrage hydroélectrique",
                    "solar_panel" => "Panneau solaire",
                    "iron_mine" => "Mine de fer",
                    "oil_mine" => "Mine de pétrole",
                    "uranium_mine" => "Mine d'uranium"
                ];


            // Nom de la structure
            echo '<h1><a href="change_name_front.php?type='.$type.'&id='.$id.'&name='.$name.'&datecrea='.$datecrea.'">'.$name.' ('.$arr[$type].')</a></h1>';


            // Rendement par mois
            $r = "SELECT (productionElec + productionIron + productionOil + productionUranium) FROM equilibrage WHERE typeStructure = ?;";
            $res = requestResultToArray(executeSQLRequest($r, array($type)));

            $prod = $res[0][0];
            if ($type != "iron_mine" and $type != "uranium_mine" and $type != "oil_mine") {
                $prod = round(elecProdGaussian($type, $res[0][0], $tour, $datecrea), 2);
            }

            switch ($type) {
                case 'iron_mine':
                    echo "<h2>Rendement : ".$prod." Fer par mois</h2>";
                    break;
                case 'uranium_mine':
                    echo "<h2>Rendement : ".$prod." Uranium par mois</h2>";
                    break;
                case 'oil_mine':
                    echo "<h2>Rendement : ".$prod." Pétrole par mois</h2>";
                    break;
                default:
                    echo "<h2>Rendement : ".$prod." WhattMois</h2>";
                    break;
            }


            // Prix de vente
            $r = "SELECT coutAchatDollar FROM equilibrage WHERE typeStructure = ?;";
            $res_prix = requestResultToArray(executeSQLRequest($r, array($type)));
            $price = round($res_prix[0][0] * $prod / $res[0][0]);
            echo "<h2>Prix de vente : ".$price." $</h2>";



            // Date de création
            echo "<h2>Date de création : $datecrea-ième tour</h2>";


            // Petite phrase rigolote
            if ($type != "iron_mine" and $type != "oil_mine" and $type != "uranium_mine") {
                $i = rand(0, count($random_sentence_pplt[$type])-1);
                echo '<h3>'.$random_sentence_pplt[$type][$i].'</h3>';
            }


            // Bouton Vendre
            echo '<button type="button" class="sell"><a href="sell_struct.php?id='.$id.'&price='.$price.'"><img src="textures/vendre.png"></a></button>';
        ?>


    </body>
</html>
