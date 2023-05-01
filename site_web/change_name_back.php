<?php
    $new_name = $_POST["new_name"];
    $type = $_GET["type"];
    $id = $_GET['id'];
    $datecrea = $_GET["datecrea"];

    include("function_for_bdd.php");

    $r = "UPDATE `structure` SET `nom` = ? WHERE idStructure = ?;";
    executeSQLRequest($r, array($new_name, $id));
?>
<script>
    window.top.location.reload();
</script>
