<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/central-changernom.css">
        <title></title>
    </head>
    <body>
        <?php
        $type = $_GET["type"];
        $name = $_GET["name"];
        $id = $_GET['id'];
        $datecrea = $_GET["datecrea"];

        echo '
            <form class=body-changer-nom method="post" action="change_name_back.php?type='.$type.'&id='.$id.'&datecrea='.$datecrea.'">
                <p class = texte-input-nom><u>Nouveau nom :</u> <input class = input-nom type="text" name="new_name" value=""></p>
                <div class=box-boutton>
                <input class = boutton-changer-nom type="submit" name="submit" value="Changer de nom">
                <input class = boutton-annuler type="button" name="cancel" value="Annuler" onclick="goBack()">
                </div>
            </form>';
        ?>
    </body>
</html>

<?php
    // Annulation - retour sur la page précédente
    echo '
    <script type="text/javascript">
        function goBack(){
            window.location.assign("central.php?type='.$type.'&id='.$id.'&name='.$name.'&datecrea='.$datecrea.'");
        }
    </script>'
?>
