<?php

include "../function_for_bdd.php"; 


$bdd = new PDO("mysql:host=localhost;port=3306;dbname=projet_if_energie;charset=utf8", "root", "");

if(isset($_POST["pseudo"])&& isset($_POST["mdp"]))
{
    $pseudo = $_POST["pseudo"];
    $mdp= $_POST["mdp"];
    
    $req= executeSQLRequest("SELECT pseudo, motDepasse FROM joueur WHERE pseudo = ? ",[$pseudo]);

    //$req = $bdd->prepare("SELECT pseudo, motDepasse FROM joueur WHERE pseudo = ? ");
    //$req->execute([$pseudo]);

    $res = $req->fetch();





    if ($res != null && password_verify($mdp, $res['motDepasse'])) {

        session_start();
        $_SESSION['pseudo'] = $pseudo;
        header("Location: ../main.php");


 
    } else {
        header("Location: connexion_front.php?error=mdp_not_correct");
       
    }

} else {
    echo  "<p class = 'texteerreur' >Erreur</p>";
}

?>  