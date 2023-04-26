<?php
    include("function_for_bdd.php");

    $type = $_GET["type"];
    $playerId = $_GET["playerid"];
    $tour = $_GET["tour"];

    $r = "INSERT INTO `structure` (`idProprietaire`, `type`, `nom`, `tourCreation`) VALUES (?, ?, 'Eolienne 1', ?);";
    executeSQLRequest($r, array($playerId, $type, $tour));

?>
<script>
    window.top.location.reload();
</script>
