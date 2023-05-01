<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/accueil.css">
</head>
<body>

    <div class="nav-barre">
        <div class="nav-barre-gauche">
            <img  class = "logo_du_jeu_nav" src="textures/logo_energie.png">
        </div>
        <div class="nav-barre-centre">
            <h1 class="nav-barre-titre"><u> Acceuil </u><h1>
        </div>
        <div class="nav-barre-droite">
            <div class="nav-barre-droite-gauche">
                <button class="nav-barre-boutton" onclick="window.location.href='connexion_inscription/inscription_front.php'">
                    <span>Inscription</span>
                </button>
            </div>
            <div class="nav-barre-droite-droite">
            <button class="nav-barre-boutton" onclick="window.location.href='connexion_inscription/connexion_front.php'">
                    <span>Connexion</span>
                </button>
            </div>
        </div>
    </div>


    <div class="body-accueil">

        <div class="body-accueil-gauche">

                <h2 class="body-accueil-gauche-titre">Bienvenue sur « Le jeu des énergie».</h2>

                <p class="body-accueil-gauche-texte">Récolté de l'Energie, des<br> Ressources et de l'Argent<br> et echangé les avec vos amis.<br><br>Tenter de devenir le boss<br> de l'Energie.</p>

        </div>

        <div class="body-accueil-droite">
            <div class="body-accueil-droite-box-image">
            <img  onclick="rotation()" id = "img" class = "logo_du_jeu_bodyaccueil" src="textures/logo_energie.png">

            </div>
        </div>
    
        <div>
        <?php
    if(isset($_GET["reussi"])) {
        if($_GET["reussi"] == "deconnexion") {
            echo  "<p class = 'textereussi' >Vous etes bien deconnecté</p>";
        } else {
            echo  "<p class = 'textereussi' >La deconnexion à échoué</p>";
        }
        }
        ?>
    </div>
            

    </div>
    <img  class = "test" src="textures/wattouat.png">
</body>

<script>



let cmpt = 0;

function rotation() {
  cmpt++;

  if (cmpt === 1) {


  var img = document.getElementById("img");
  var angle = 0;
  var interval = setInterval(function() {
    angle += 10;
    img.style.transform = "rotateZ(" + angle + "deg)";

    if (cmpt === 2) {
      clearInterval(interval);
      cmpt = 0
    }
 }, 8);



  }
}


</script>

</html>
