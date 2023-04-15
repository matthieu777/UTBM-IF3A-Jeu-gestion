<?php
    include("function_for_bdd.php");

    $type = $_GET["type"];
    $name = $_GET["name"];
    $id = $_GET['id'];
    $datecrea = $_GET["datecrea"];

    $r = "DELETE FROM structure WHERE idStructure = ?";
    executeSQLRequest($r, array($id));

    header("Location: central.php?type=".$type."&name=".$name."&datecrea=".$datecrea."&id=".$id);
?>
