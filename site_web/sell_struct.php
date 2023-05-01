<?php
    include("function_for_bdd.php");

    $id = $_GET['id'];
    $price = $_GET['price'];

    // Ajout à la base de donnée de l'argent gagné lors de la vente
    $r = "UPDATE joueur SET numeroArgent = numeroArgent + ? WHERE idJoueur = (SELECT idProprietaire FROM structure WHERE idStructure = ?)";
    executeSQLRequest($r, array($price, $id));

    $r = "DELETE FROM structure WHERE idStructure = ?";
    executeSQLRequest($r, array($id));
?>
<script>
  top.window.location = 'main.php';
</script>
