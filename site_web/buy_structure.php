<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Acheter des Structures</title>
    </head>
    <body>
        <?php
            $type = $_GET["type"];
            $prices = ['dollar' => 0, 'iron' => 0, 'oil' => 0, 'uranium' => 0];
            switch ($type) {
                case 'nuclear_plant':
                    echo "<h1>Acheter une centrale nucléaire</h1>";
                    $prices['dollar'] = 17;
                    $prices['iron'] = 4;
                    break;
                case 'oil_power_station':
                    echo "<h1>Acheter une centrale à pétrole</h1>";
                    $prices['dollar'] = 10;
                    $prices['iron'] = 3;
                    break;
                case 'wind_turbine':
                    echo "<h1>Acheter une éolienne</h1>";
                    $prices['dollar'] = 3;
                    $prices['iron'] = 1;
                    break;
                case 'dam':
                    echo "<h1>Acheter un barrage hydroélectrique</h1>";
                    $prices['dollar'] = 12;
                    $prices['iron'] = 2;
                    break;
                case 'solar_panel':
                    echo "<h1>Acheter un panneau solaire</h1>";
                    $prices['dollar'] = 1;
                    $prices['iron'] = 1;
                    break;
                default:
                    echo "<h1>Type inconnu</h1>";
                    break;
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
        ?>
        <input id="button" type="submit" name="button" onclick="myFunction();" value="Acheter"/>
        <script>
        function myFunction(){
            window.top.location.reload();
        };
        </script>
    </body>
</html>
