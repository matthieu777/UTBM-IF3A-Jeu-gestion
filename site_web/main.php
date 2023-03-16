<!-- FUNCTIONS -->

<!-- A function used to generate css code for image-link clickable buttons -->
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

    function writeImageButtonJS(string $link, string $button_id){
        echo "<script type='text/javascript'>
        main.getElementById('".$button_id."').onclick = function() {
            alert('button was clicked');
        }​;
        </script>";
    }
?>


<!-- CODE -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Jeu des énergies !</title>
    </head>
    <body>
        <!-- Write CSS -->
        <?php
            writeClickableImageCSS("info_menu_pic", 125, 125);
            writeClickableImageCSS("menu_pic", 200, 200);
            writeClickableImageCSS("power_plant_pic", 60, 60);
            writeClickableImageCSS("mines_pic", 60, 60);
        ?>

        <!-- Graph iframe -->

        <iframe id="graph_iframe" name="graph_iframe" src="" width="200" height="100"></iframe>


        <!-- Display of the button menu -->

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


        <!-- Display of the subpage handling every miscellaneous displays -->

        <iframe src="" name="misc_display_iframe" id="misc_display_iframe" height=600 width=50%  style="float: right" scrolling=no></iframe>


        <!-- Display of the centrals/mines -->

        <?php
            $powplt_list = ["nuclear_plant" => 1, "oil_power_station" => 2, "wind_turbine" => 5, "solar_panel" => 0, "dam" => 1];
            foreach ($powplt_list as $key => $value) {
                echo '<div class="'.$key.'">';

                echo '<button id="buy_pplt" type="button" name="button"><img src="textures/plus.png"></button>';

                for ($i=0; $i < $value; $i++) {
                    echo '<a href="central.php?type='.$key.'&id='.$i.'" target="misc_display_iframe"><img src="textures/'.$key.'.png" class="power_plant_pic"></a>';
                }

                echo "</div>";
            }
        ?>

        <br>

        <?php
            $mine_list = ["uranium" => 1, "iron" => 2, "oil" => 2];
            foreach ($mine_list as $key => $value) {
                echo '<div class="'.$key.'">';

                echo '<button id="buy_mine" type="button" name="button"><img src="textures/plus.png"></button>';

                for ($i=0; $i < $value; $i++) {
                    echo '<a href="central.php?type='.$key.'&id='.$i.'" target="misc_display_iframe"><img src="textures/'.$key.'.png" class="mines_pic"></a>';
                }

                echo "</div>";
            }
        ?>

    </body>
</html>
