<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Détail des centrales</title>
    </head>
    <body>
        <?php
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
            $type = $_GET["type"];
            switch ($type) {
                case 'wind_turbine':
                    echo "<h1>Eolienne</h1>";
                    break;
                case 'oil_power_station':
                    echo "<h1>Centrale à pétrole</h1>";
                    break;
                case 'nuclear_plant':
                    echo "<h1>Centrale nucléaire</h1>";
                    break;
                case 'dam':
                    echo "<h1>Barrage hydroélectrique</h1>";
                    break;
                case 'solar_panel':
                    echo "<h1>Panneau solaire</h1>";
                    break;
                default:
                    echo "<h1>Undefined Structure</h1>";
                    break;
            }
        ?>

        <h2>Rendement : ___ WhattMois</h2>
        <h2>Prix de vente : ___ $</h2>
        <h2>Date de création : __/__/____</h2>

        <?php
            $i = rand(0, count($random_sentence_pplt[$type])-1);
            echo '<h3>'.$random_sentence_pplt[$type][$i].'</h3>';
        ?>

        <button type="button" class="sell">Vendre</button>
    </body>
</html>
