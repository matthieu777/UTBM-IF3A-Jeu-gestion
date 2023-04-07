<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Détail du <?php echo $_GET["type"]; ?></title>
    </head>
    <body>
        <?php
        include("function_for_bdd.php");
        $type = $_GET["type"]; $player = 1; $indice_type = 5;?>

        <h1>Détail <?php if ($type =='dollar') {
            echo 'du gain d\'argent';$indice_type = 0;}
          elseif ($type =='electricity') {
            echo 'de ta production d\'éléctricité';$indice_type = 1;}
          elseif ($type =='iron') {
            echo 'du gain de fer';$indice_type = 2;}
          elseif ($type =='oil') {
            echo ' du gain de pétrole';$indice_type = 3;}
          elseif ($type =='uranium') {
            echo ' du gain d\'uranium';$indice_type = 4;}
         ?></h1>

        <ol>
            <li>Nombre actuel de <?php echo $_GET["type"]; ?> : <?php
                $liste_ligne = ['nArgent','nElec', 'nFer', 'nPetrole', 'nUranium'];

                echo executeSQLRequest("SELECT $liste_ligne[$indice_type] FROM joueur WHERE idJoueur = $player", array());



            ?></li>
            <ol>
                <li>Mine/Centrales : +___</li>
                <li>Contrats : +___</li>
                <li>Mine/Centrales : -___</li>
                <li>Contrats : -___</li>
            </ol>
            <li>Total au prochain mois : ___</li>
            <li>__Total__ - __Demande__</li>
        </ol>
    </body>
</html>

