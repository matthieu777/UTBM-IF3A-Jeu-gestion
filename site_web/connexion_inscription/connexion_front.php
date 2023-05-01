<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/connexion.css">
</head>
<body>
    
    <div class="nav-barre">
        <div class="nav-barre-gauche">
        <img  class = "logo_du_jeu_nav" src="../textures/logo_energie.png">
        </div>
        <div class="nav-barre-centre">
            <h1 class="nav-barre-titre"><u> Inscription</u><h1>
        </div>
        <div class="nav-barre-droite">
            <div class="nav-barre-droite-gauche">
                <button class="nav-barre-boutton" onclick="window.location.href='../accueil.php'">
                    <span>Accueil</span>
                </button>
            </div>
            <div class="nav-barre-droite-droite">
            <button class="nav-barre-boutton" onclick="window.location.href='connexion_front.php'">
                    <span>Connexion</span>
                </button>
            </div>
        </div>
    </div>




    

    <div class="body-connexion">
    <div class = "contour">

        <div class="titre-connexion"><h2><u>CONNEXION :</u></h2></div>

    <div class ="inputconnexionensemble">


    

    <form action="connexion_back.php" method="post">




        <div class="inputconnexion">
            <p class="inputconnexiontext">Pseudo:</p>
            <input class="inputconnexionreponse" type = "text" name = "pseudo" placeholder="Entrez votre pseudo"/>
        </div>



<div class="inputconnexion">
    <p class="inputconnexiontext">Mot de passe :</p>
    <input class="inputconnexionreponse" id= "mdp" type = "password"  name ="mdp" placeholder="Entrez votre mot de passe"/>

    <button class="affichermdp" type="button" onclick="affichermdp()">mdp</button>
</div>




<div class="boutonentrer">
    <input class="boutonentretext" type="submit" value ="Valider">
</div>

<?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "mdp_not_correct") {
            echo  "<p class = 'texteerreur' >Erreur, les infos ne correspondes pas</p>";
        }

                
    } else if (isset($_GET["reussi"])) {
        if($_GET["reussi"] == "inscription") {
            echo"<p class = 'textereussi' >Inscription effectuée, connectez-vous </p>";
        }

                
    }


    
    
    ?>


</form>
    

    
        
    </div>
    </div>
    </div>

</body>

<script>

function affichermdp() {

  var mdpafficher = document.getElementById("mdp");

  if (mdpafficher.type === "password") {
    mdpafficher.type = "text";

  } else {
    mdpafficher.type = "password";
  }
}
</script>

</html>