<?php
    include("function_for_bdd.php");

    $type = $_GET["type"];
    $playerId = $_GET["playerid"];
    $tour = $_GET["tour"];

    $price_dollar = $_GET["price_dollar"];
    $price_iron = $_GET["price_iron"];
    $price_oil = $_GET["price_oil"];
    $price_uranium = $_GET["price_uranium"];

    switch ($type) {
        case 'wind_turbine':
            $name = "Eolienne";
            break;
        case 'oil_power_station':
            $name = "Centrale à pétrole";
            break;
        case 'nuclear_plant':
            $name = "Centrale nucléaire";
            break;
        case 'dam':
            $name = "Barrage hydroélectrique";
            break;
        case 'solar_panel':
            $name = "Panneau solaire";
            break;
        case 'iron_mine':
            $name = "Mine de fer";
            break;
        case 'oil_mine':
            $name = "Mine de pétrole";
            break;
        case 'uranium_mine':
            $name = "Mine d'uranium";
            break;
        default:
            $name = "Undefined";
            break;
    }

    $r = "SELECT COUNT(*) + 1 FROM structure WHERE structure.type = ?";
    $num = requestResultToArray(executeSQLRequest($r, array($type)))[0][0];
    $name = $name." ".$num;

    $r = "INSERT INTO `structure` (`idProprietaire`, `type`, `nom`, `tourCreation`) VALUES (?, ?, ?, ?);";
    executeSQLRequest($r, array($playerId, $type, $name, $tour));

    $r = "UPDATE joueur SET numeroArgent = numeroArgent - ?, nombreFer = nombreFer - ?, nombrePetrole = nombrePetrole - ?, nombreUranium = nombreUranium - ? WHERE idJoueur = ?";
    executeSQLRequest($r, array($price_dollar, $price_iron, $price_oil, $price_uranium, $playerId));
?>
<script>
  top.window.location = 'main.php';
</script>
