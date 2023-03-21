<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Détail du <?php echo $_GET["type"]; ?></title>
    </head>
    <body>
        <?php $type = $_GET["type"]; $player = 1; $indice_type = 5;?>

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
                try
                {
                    $bdd = new PDO("mysql:host=localhost;port=3306;dbname=projet_energie;charset=utf8", "root", "");  // lier la base de donnees, a mon avis pas besoin de le mettre tt le temps
                }
                catch (Exception $e)
                {
                    echo 'la base de donnée n\'a pas pu etre chargé';
                    die('Erreur : ' . $e->getMessage()); // si ca marche pas ca dit qu'il y a une erreur
                }
                $req = $bdd->prepare("SELECT $liste_ligne[$indice_type] FROM joueur WHERE idJoueur = $player"); // req contient une requette SQL
                $req->execute(); // On l'execute
                $donnees = $req->fetch(); //On transforme ca en donnees exploitable
                echo $donnees[$liste_ligne[$indice_type]];

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
