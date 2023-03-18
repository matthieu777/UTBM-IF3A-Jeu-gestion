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

    function writeButtonMenuCSS(string $class, int $left, int $top){
        echo '<style>
                .'.$class.'{
                    position: absolute;
                    left: '.$left.'%;
                    top: '.$top.'%
                }
            </style>';
    }

    function writeIframeCSS(string $id, int $right, int $top){
        echo '<style>
                #'.$id.'{
                    position: absolute;
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
    </head>
    <body>
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
        <!-- Graph iframe -->

        <iframe id="graph_iframe" name="graph_iframe" src="" width="25%" height="33%"></iframe>


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

        <iframe src="" name="misc_display_iframe" id="misc_display_iframe" height=65% width=50%  style="float: right" scrolling=no></iframe>


        <!-- Display of the centrals/mines -->

        <?php
            $powplt_list = ["nuclear_plant" => 1, "oil_power_station" => 2, "wind_turbine" => 5, "solar_panel" => 0, "dam" => 1];
            foreach ($powplt_list as $key => $value) {
                echo '<div class="'.$key.'">';

                echo '<a href="buy_structure.php?type='.$key.'" target="misc_display_iframe"><img src="textures/plus.png" class="plus_pic"></a>';

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

                echo '<a href="buy_structure.php?type='.$key.'" target="misc_display_iframe"><img src="textures/plus.png" class="plus_pic"></a>';

                for ($i=0; $i < $value; $i++) {
                    echo '<a href="central.php?type='.$key.'&id='.$i.'" target="misc_display_iframe"><img src="textures/'.$key.'.png" class="mines_pic"></a>';
                }

                echo "</div>";
            }
        ?>

    </body>
</html>
