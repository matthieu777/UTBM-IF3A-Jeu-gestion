<?php
    include("function_for_bdd.php");

    $type = $_GET["type"];
    $playerId = $_GET["playerid"];

    $r = "INSERT INTO `structure` (`idProprietaire`, `type`, `nom`, `tourCreation`) VALUES (?, ?, 'Eolienne 1', '0');";
    executeSQLRequest($r, array("$playerId", "$type"));

?>
<script>
    window.top.location.reload();
</script>
