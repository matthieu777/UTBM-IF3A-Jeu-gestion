<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Détail des centrales</title>
    </head>
    <body>
        <?php
            $type = $_GET["type"];
            $name = $_GET["name"];
            $id = $_GET['id'];
            $datecrea = $_GET["datecrea"];

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
                    "iron" => "Mine de fer",
                    "oil" => "Pompe à pétrole",
                    "uranium" => "Mine d'uranium"
                ];

            echo '<h1><a href="change_name_front.php?type='.$type.'&id='.$id.'&name='.$name.'&datecrea='.$datecrea.'">'.$name.' ('.$arr[$type].')</a></h1>';

            echo "<h2>Rendement : __ WhattMois</h2>";
            echo "<h2>Prix de vente : __ $</h2>";
            echo "<h2>Date de création : $datecrea-ième tour</h2>";

            if ($type != "iron" and $type != "oil" and $type != "uranium") {
                $i = rand(0, count($random_sentence_pplt[$type])-1);
                echo '<h3>'.$random_sentence_pplt[$type][$i].'</h3>';
            }

        echo '<button type="button" class="sell"><a href="sell_struct.php?type='.$type.'&name='.$name.'&datecrea='.$datecrea.'&id='.$id.'">Vendre</a></button>';
        ?>


    </body>
</html>
