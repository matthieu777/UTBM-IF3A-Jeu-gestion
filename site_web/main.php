<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Jeu des énergies !</title>
    </head>
    <body>
        <button class="dollar"><a href="detail.php" target="iframe">valeur</a></button>
        <button class="elec"><a href="detail.php" target="iframe">valeur</a></button>
        <button class="iron"><a href="detail.php" target="iframe">valeur</a></button>
        <button class="coal"><a href="detail.php" target="iframe">valeur</a></button>
        <button class="uranium"><a href="detail.php" target="iframe">valeur</a></button>

        <?php
            $i = 0;
            for ($i = 0; $i < 5; $i++) {
                echo "$i";
            }
        ?>

        <style media="screen">
            .dollar{
                background-image: url("images/dollar.png");
                height: 100px;
                width: 100px;
                background-size: cover;
            }
        </style>
        <a href="market.php" target="iframe">Market Place</a>
        <a href="central.php" target="iframe">Contrats en cours</a>
        <iframe src="" name="iframe" id="iframe" height=600 width=100%  style="border: none" scrolling=no></iframe>
    </body>
</html>
