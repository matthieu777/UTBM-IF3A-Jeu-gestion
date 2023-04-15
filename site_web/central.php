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

            switch ($type) {
                case 'wind_turbine':
                    echo "<h1>$name (Eolienne)</h1>";
                    break;
                case 'oil_power_station':
                    echo "<h1>$name (Centrale à pétrole)</h1>";
                    break;
                case 'nuclear_plant':
                    echo "<h1>$name (Centrale nucléaire)</h1>";
                    break;
                case 'dam':
                    echo "<h1>$name (Barrage hydroélectrique)</h1>";
                    break;
                case 'solar_panel':
                    echo "<h1>$name (Panneau solaire)</h1>";
                    break;
                case 'iron':
                    echo "<h1>$name (Mine de fer)</h1>";
                    break;
                case 'oil':
                    echo "<h1>$name (Pompes à pétroles)</h1>";
                    break;
                case 'uranium':
                    echo "<h1>$name (Mine d'uranium)</h1>";
                    break;
                default:
                    echo "<h1>$name (Undefined Structure)</h1>";
                    break;
            }


            echo "<h2>Rendement : __ WhattMois</h2>";
            echo "<h2>Prix de vente : __ $</h2>";
            echo "<h2>Date de création (en tour) : $datecrea</h2>";

            if ($type != "iron" and $type != "oil" and $type != "uranium") {
                $i = rand(0, count($random_sentence_pplt[$type])-1);
                echo '<h3>'.$random_sentence_pplt[$type][$i].'</h3>';
            }

        echo '<button type="button" class="sell"><a href="sell_struct.php?type='.$type.'&name='.$name.'&datecrea='.$datecrea.'&id='.$id.'">Vendre</a></button>';
        ?>


    </body>
</html>
