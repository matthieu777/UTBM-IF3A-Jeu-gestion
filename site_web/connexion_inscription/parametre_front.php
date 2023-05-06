<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>parametre</title>
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


            <?php
    
    if(isset($_GET["error"])) {
        if($_GET["error"] == "mdp_not_correct") {
            echo "<p class = 'texteerreur' >L'ancien mdp n'est pas correct</p>";
        }
        if($_GET["error"] == "mdp_not_egal") {
            echo"<p class = 'texteerreur' >Le nouveau mdp ne correspond pas</p>";
        }
    }
        

        if(isset($_GET["reussi"])) {
            if($_GET["reussi"] == "mdp_modif") {
                echo "<p class = 'textereussi' >Votre mdp a bien été modifié</p>";
            }
    }
    ?>




            
            </form>
        
        </div>



        <div class = "body-modif-map">
            <div class="box-titre">
            <h1><u>règles du jeu : </u><h1>
            </div>
            <p class=regle>Ce jeu est un subtil mélange entre un jeu de gestion et Cookie Clicker. Le but est de maintenir une production électrique supérieure à la demande pour la distribuer à tout le monde. Pour ce faire, vous pouvez acheter différents types de centrales afin de produire de l'énergie ou des mines pour produire des ressources dans le but de fabriquer plus de centrales. Vous pouvez également faire des échanges de ressources avec les autres joueurs en compétitions contre vous.<br><br>

Les centrales ne produisent pas toutes au même rythme, et attention : elles s'usent ! A vous de bien savoir gérer pour éviter de se retrouver des centrales dépassées qui ne produisent plus rien. <br><br>

Bon courage ! 
 </p>
        </div>


    </div>




</body>



</html>
