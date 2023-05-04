
<?php

include "../function_for_bdd.php";

if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["pseudo"]) && isset($_POST["mail"]) && isset($_POST["mdp"])&& isset($_POST["mdpverif"]))
{
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $pseudo = $_POST["pseudo"];
    $email = $_POST["mail"];
    $mdp = $_POST["mdp"];
    $mdpverif = $_POST["mdpverif"];
    $mdpcrypte = password_hash($mdp, PASSWORD_DEFAULT);





    //$bdd = new PDO("mysql:host=localhost;port=3306;dbname=projet_if_energie;charset=utf8", "root", "");


    $reqverifpseudo= executeSQLRequest("SELECT * FROM joueur WHERE pseudo = ?",[$pseudo]);

    //$reqverifpseudo = $bdd->prepare("SELECT * FROM joueur WHERE pseudo = ?");
    //$reqverifpseudo->execute([$pseudo]);

    if ($reqverifpseudo->fetch() == null ){
        $donneesreqverifpseudo = 0;
    } else {
        $donneesreqverifpseudo = 1; //si il est deja dans la base
    }

    $reqverifmail = executeSQLRequest("SELECT * FROM joueur WHERE email = ?",[$email]);

    //$reqverifmail = $bdd->prepare("SELECT * FROM joueur WHERE email = ?");

    //$reqverifmail->execute([$email]);

    if ($reqverifmail->fetch() == null ){
        $donneesreqverifmail = 0;
    } else {
        $donneesreqverifmail = 1; //si il est deja dans la base
    }

    if(($donneesreqverifpseudo ) != 0){
        header("Location: inscription_front.php?error=duplicate_login");
    }

    else if (($donneesreqverifmail ) != 0){

        header("Location: inscription_front.php?error=duplicate_mail");

      } else if($mdp != $mdpverif ){

        header("Location: inscription_front.php?error=mdp_not_egal");

      }

      else {
        // creation de la map
        executeSQLRequest("INSERT INTO `map` () VALUES ();",array());

        $req = executeSQLRequest("SELECT MAX(idPartie) FROM map",array());
        $idPartie = $req->fetch();
        $nombrejoueur["COUNT(*)"] =1;
        $liste_prenom_bot = ["Pierre","Robin","Alain"];
        $liste_nom_bot = ["Kiroule","Moussant","Verse"];
        while ($nombrejoueur["COUNT(*)"] == 1) {
          $r = rand(0,2);
          $req = executeSQLRequest("SELECT COUNT(*) FROM joueur WHERE pseudo = ?", array($liste_prenom_bot[$r].$liste_nom_bot[$r]));
          $nombrejoueur = $req -> fetch();
        }
        executeSQLRequest("insert into joueur (nom,prenom,pseudo,email,motDePasse,numeroPartie) values (?,?,?,?,?,?)",array($liste_nom_bot[$r] , $liste_prenom_bot[$r] , $liste_prenom_bot[$r].$liste_nom_bot[$r] , $liste_prenom_bot[$r].'.'.$liste_nom_bot[$r].'@gmail.bot' ,  '1234' ,$idPartie["MAX(idPartie)"] ));

        $req = executeSQLRequest("insert into joueur (nom,prenom,pseudo,email,motDePasse,numeroPartie) values (?,?,?,?,?,?)",array($nom , $prenom , $pseudo , $email ,  $mdpcrypte ,$idPartie["MAX(idPartie)"] ));



        //$req = $bdd->prepare("insert into joueur (nom,prenom,pseudo,email,motDePasse) values (?,?,?,?,?)");
        //$req->execute(array($nom , $prenom , $pseudo , $email ,  $mdpcrypte ));



        if ($req){

            header("Location: connexion_front.php?reussi=inscription");

        } else {

            header("Location: inscription_front.php?error=erreur");

        }

      }

}

?>
