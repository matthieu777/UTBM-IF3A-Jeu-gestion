<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php
        $type = $_GET["type"];
        $name = $_GET["name"];
        $id = $_GET['id'];
        $datecrea = $_GET["datecrea"];

        echo '
            <form method="post" action="change_name_back.php?type='.$type.'&id='.$id.'&datecrea='.$datecrea.'">
                <p>Nouveau nom : <input type="text" name="new_name" value=""></p>
                <input type="submit" name="submit" value="Changer de nom">
                <input type="button" name="cancel" value="Annuler" onclick="goBack()">
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
