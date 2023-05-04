<?php
    $idContrat = $_GET["idContrat"];
    $idPlayer = $_GET["idPlayer"];

    include("function_for_bdd.php");

    $r = "SELECT idVendeur, ressource1, valeur1, ressource2, valeur2 FROM contrat WHERE idContrat = ?";
    $res = requestResultToArray(executeSQLRequest($r, array($idContrat)));

    $r = "DELETE FROM contrat WHERE idContrat = ?";
    executeSQLRequest($r, array($idContrat));

    $arr = [
        "dollar" => "numeroArgent",
        "electricity" => "nombreElec",
        "iron" => "nombreFer",
        "oil" => "nombrePetrole",
        "uranium" => "nombreUranium"
    ];

    $r = "UPDATE joueur SET ".$arr[$res[0][1]]." = ".$arr[$res[0][1]]." + ?, ".$arr[$res[0][3]]." = ".$arr[$res[0][3]]." - ? WHERE idJoueur = ?";
    executeSQLRequest($r, array(intval($res[0][2]), intval($res[0][4]), $idPlayer));

    $r = "UPDATE joueur SET ".$arr[$res[0][3]]." = ".$arr[$res[0][3]]." + ?, ".$arr[$res[0][1]]." = ".$arr[$res[0][1]]." - ? WHERE idJoueur = ?";
    executeSQLRequest($r, array(intval($res[0][4]), intval($res[0][2]), $res[0][0]));
?>
