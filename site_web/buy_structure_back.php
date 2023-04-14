<?php
    include("function_for_bdd.php");

    $type = $_GET["type"];
    $playerId = $_GET["playerid"];

    $r = "INSERT INTO `structure` (`idProprietaire`, `type`, `nom`, `dateCreation`) VALUES (?, ?, 'Eolienne 1', '0');";
    executeSQLRequest($r, array("$playerId", "$type"));

    header("Location: buy_structure_front.php?type=".$type."&playerid=".$playerId);
?>
