<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/partie.css">
</head>
<body>
    
    




    

    <div class="body-partie">
    <div class = "contour">

        <div class="titre-partie"><h2><u>Choisissez votre partie:</u></h2></div>



        <div class ="inputpartieensemble">
        


            <div class="ensemble_partie_reprendre">
                <p class="reprendre_partie_texte">Creer nouvelle partie :</p>
            <?php
            
            include "../function_for_bdd.php";
            

            if(isset($_GET["pseudo"])){
                    $pseudo = $_GET["pseudo"];
            }

           
            $req= executeSQLRequest("SELECT numeroPartie FROM joueur WHERE pseudo = ? ",[$pseudo] );
            $map = $req->fetch();

            echo '<p class="partie_chiffre">' .$map[0]. ' </p>';
            
            ?>

                <input class="boutonentre" type="submit" value ="Valider" onclick="window.location.href='../main.php'">
            </div>
            <form method="post">
            <div class="ensemble_partie_changer">
                <p class="changer_partie_texte">Rejoindre partie existante :</p>
                <input class="input_changer_partie" type = "text" name = "nouvelle_partie" placeholder="......................"/>
                <input class="boutonentre" type="submit" value ="Valider">
            </div>
        </from>
        </div>

        <?php 
        
        if(isset($_POST["nouvelle_partie"]))
        {
            $nouvellemap = $_POST["nouvelle_partie"];
            $req= executeSQLRequest("SELECT * FROM joueur WHERE numeroPartie = ? ",[$nouvellemap]);
            $res = $req->fetch();
            if($res != null){
                $req= executeSQLRequest("UPDATE joueur SET numeroPartie = '$nouvellemap ' WHERE pseudo = ? ",[$pseudo]);
                header("Location: connexion_front.php?reussi=inscription");
            } else {
                echo"<p class='texteerreur'>La partie n'existe pas</p>";
            }
            
            
        }

        ?>
  
    </div>
    </div>

</body>
</html>