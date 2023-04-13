<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/inscription.css">
</head>
<body>
    
    <div class="nav-barre">
        <div class="nav-barre-gauche">
        <img  class = "logo_du_jeu_nav" src="textures/logo_energie.png">
        </div>
        <div class="nav-barre-centre">
            <h1 class="nav-barre-titre"><u> Inscription</u><h1>
        </div>
        <div class="nav-barre-droite">
            <div class="nav-barre-droite-gauche">
                <button class="nav-barre-boutton" onclick="window.location.href='acceuil.php'">
                    <span>Acceuil</span>
                </button>
            </div>
            <div class="nav-barre-droite-droite">
            <button class="nav-barre-boutton" onclick="window.location.href='connexion.php'">
                    <span>Connexion</span>
                </button>
            </div>
        </div>
    </div>


    <div class="body-inscription">
        <div class = "contour">
        <div class="titre-inscription"><h2><u>INSCRIPTION :</u></h2></div>

    <div class ="inputinscriptionensemble">

    

    <form action="inscription_back.php" method="post">

        <div class="inputinscription">
            <p class="inputinscriptiontext"> Nom :</p>
            <input class="inputinscriptionreponse" type = "text" name="nom" placeholder="entrer votre nom"/>
        </div>
        
        <div class="inputinscription">
            <p class="inputinscriptiontext">Prenom :</p>
            <input class="inputinscriptionreponse" type = "text" name = "prenom" placeholder="entrer votre prenom"/>
        </div>

        <div class="inputinscription">
            <p class="inputinscriptiontext">Pseudo:</p>
            <input class="inputinscriptionreponse" type = "text" name = "pseudo" placeholder="entrer votre pseudo"/>
        </div>
        
        <div class="inputinscription">
            <p class="inputinscriptiontext">Email :</p>
            <input class="inputinscriptionreponse" type = "email" name ="mail" placeholder="entrer votre numero"/>
        </div>

        <div class="inputinscription">
            <p class="inputinscriptiontext">Mots de passe :</p>
            <input class="inputinscriptionreponse" id= "mdp" type = "password"  name ="mdp" placeholder="entrer votre mots de passe"/>

            <button class="affichermdp" type="button" onclick="affichermdp()">mdp</button>
        </div>

        <div class="inputinscription">
            <p class="inputinscriptiontext">Confirmation :</p>
            <input class="inputinscriptionreponse" id= "mdp2" type = "password"  name ="mdpverif" placeholder="entrer votre mots de passe"/>
        </div>


        <div class="boutonentrer">
            <input class="boutonentretext" type="submit" value ="Valider">
        </div>

        <?php
        include "inscription_back.php";
        echo $message;
        ?>

 
    </form>
        
        </div>

    </div>
    </div>

</body>

<script>

function affichermdp() {
  var mdpafficher = document.getElementById("mdp");
  var mdpafficher2 = document.getElementById("mdp2");

  if (mdpafficher2.type === "password" || mdpafficher.type === "password" ) {
    mdpafficher2.type = "text";
    mdpafficher.type = "text";
  } else {
    mdpafficher2.type = "password";
    mdpafficher.type = "password";
  }
}
</script>

</html>