<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/parametre.css">
</head>
<body>

<?php session_start(); 
?>





<div class="nav-barre">
        <div class="nav-barre-gauche">
            <img  class = "logo_du_jeu_nav" src="../textures/logo_energie.png">
        </div>
        <div class="nav-barre-centre">
            <h1 class="nav-barre-titre"><u> Industries de <?php echo $_SESSION['pseudo']?></u><h1>
        </div>
        <div class="nav-barre-droite">
            <div class="nav-barre-droite-gauche">
                <button class="nav-barre-boutton" onclick="window.location.href='../main.php'">
                    <span>Jeu</span>
                </button>
            </div>
            <div class="nav-barre-droite-droite">
            <form method="POST">
            <button class="nav-barre-boutton" name="deconnexion">
                    <span><img class = "nav-barre-boutton-logo" src="../textures/logo-deconexion.png"></span>
                </button>
            </form>
            </div>
        </div>
        </div>


        <?php
        if (isset($_POST['deconnexion'])) { 
        session_destroy();
        header('Location: ../accueil.php?reussi=deconnexion');
        }
        ?>



    <div class="body-parametre">
        <div class = "body-modif-mdp">
            <div class="box-titre">
                <h1><u>Modifier votre mdp : </u><h1>
            </div>

            <form class="box-formulaire-mdp" action="parametre_back.php" method="post">


           

            <div class="inputmodifmdp">
                <p class="inputmdptext">Ancien mot de passe :</p>
                <input class="inputmdpreponse" id= "" type = "password"  name ="ancienmdp" placeholder="Entrez votre mot de passe"/>
            </div>

            <div class="inputmodifmdp">
            <p class="inputmdptext">Nouveau mot de passe :</p>
            <input class="inputmdpreponse" id= "" type = "password"  name ="nouveaumdp" placeholder="Entrez votre mot de passe"/>

            </div>

            <div class="inputmodifmdp">
                <p class="inputmdptext">Confirmation :</p>
                <input class="inputmdpreponse" id= "" type = "password"  name ="nouveaumdpverif" placeholder="Entrez votre mot de passe"/>
            </div>
        
            <div class="boutonentrer">
                <input class="boutonentretext" type="submit" value ="Valider">
            </div>

            
            </form>
        
        </div>



        <div class = "body-modif-map">

        </div>


    </div>




</body>



</html>