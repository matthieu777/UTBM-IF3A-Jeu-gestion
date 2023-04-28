<?php

include "../function_for_bdd.php";
session_start();

if(isset($_POST["ancienmdp"]) && isset($_POST["nouveaumdp"]) && isset($_POST["nouveaumdpverif"]))
{
    $ancienmdp = $_POST["ancienmdp"];
    $nouveaumdp = $_POST["nouveaumdp"];
    $nouveaumdpverif = $_POST["nouveaumdpverif"];
    $pseudo = $_SESSION['pseudo'];

    $req= executeSQLRequest("SELECT motDepasse FROM joueur WHERE pseudo = ? ",[$pseudo]);
    $res = $req->fetch();

    if($res != null && password_verify($ancienmdp, $res['motDepasse'])){
        if($nouveaumdp != $nouveaumdpverif  ){

            header("Location: parametre_front.php?error=mdp_not_egal");
    
          }
    } else {
            header("Location: parametre_front.php?error=mdp_not_correct");
    }

}

?>