<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>
            Détails
        </title>
    </head>
    <body>
        <?php
            include("function_for_bdd.php");
            $type = $_GET["type"];
            $player = 1;
        ?>

        <h1>Détail du gain
            <?php
                $name = ['dollar' => "d'argent", 'electricity' =>  "d'électricité", 'iron' =>  'de fer', 'oil' =>  'de pétrole', 'uranium' =>  "d'uranium"];
                echo "$name[$type]";
            ?>
        </h1>

        <ol>
            <li>Nombre actuel <?php echo $name[$type]; ?> :
                <?php
                    $list = ['dollar' => 'nArgent', 'electricity' => 'nElec', 'iron' => 'nFer', 'oil' => 'nPetrole', 'uranium' => 'nUranium'];
                    $req = "SELECT ".$list[$type]." FROM `joueur` WHERE idJoueur = ?;";
                    $res = requestResultToArray(executeSQLRequest($req, array($player)));
                    echo $res[0][0];
                ?>
            </li>

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
