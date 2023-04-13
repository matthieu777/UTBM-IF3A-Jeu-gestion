<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/acceuil.css">
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
                <button class="nav-barre-boutton" onclick="window.location.href='inscription_front.php'">
                    <span>Inscription</span>
                </button>
            </div>
            <div class="nav-barre-droite-droite">
            <button class="nav-barre-boutton" onclick="window.location.href='connexion.php'">
                    <span>Connexion</span>
                </button>
            </div>
        </div>
    </div>


    <div class="body-acceuil">

        <div class="body-acceuil-gauche">

                <h2 class="body-acceuil-gauche-titre">Bienvenue sur « Le jeu des énergie».</h2>

                <p class="body-acceuil-gauche-texte">Récolté de l'Energie, des<br> Ressources et de l'Argent<br> et echangé les avec vos amis.<br><br>Tenter de devenir le boss<br> de l'Energie.</p>

        </div>

        <div class="body-acceuil-droite">
            <div class="body-acceuil-droite-box-image">
            <img  class = "logo_du_jeu_bodyacceuil" src="textures/logo_energie.png">

            </div>
        </div>

        
    </div>

</body>
</html>