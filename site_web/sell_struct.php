<?php
    include("function_for_bdd.php");

    $type = $_GET["type"];
    $name = $_GET["name"];
    $id = $_GET['id'];
    $datecrea = $_GET["datecrea"];

    $r = "DELETE FROM structure WHERE idStructure = ?";
    executeSQLRequest($r, array($id));
?>
<script>
    top.window.location = 'main.php';
</script>
