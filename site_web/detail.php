<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Détail du __ressource__</title>
    </head>
    <body>
        <?php
            $type = $_GET["type"];
            switch ($type) {
                case 'dollar':
                    echo "<h1>Détail du gain d'argent</h1>";
                    break;
                case 'electricity':
                    echo "<h1>Détail de la production électrique</h1>";
                    break;
                case 'iron':
                    echo "<h1>Détail du gain de fer</h1>";
                    break;
                case 'oil':
                    echo "<h1>Détail du gain de pétrole</h1>";
                    break;
                case 'uranium':
                    echo "<h1>Détail du gain d'uranium</h1>";
                    break;
                default:
                    echo "<h1>Undefined Ressource</h1>";
                    break;
            }
        ?>
        <ol>
            <li>Nombre actuel : ___</li>
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
