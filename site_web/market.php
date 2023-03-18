<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Market Place</title>
    </head>
    <body>
        <h1>Market Place</h1>
        <p>
        <?php
        try
        {
            $bdd = new PDO("mysql:host=localhost;port=3306;dbname=projet_energie;charset=utf8", "root", "");  // lier la base de donnees, a mon avis pas besoin de le mettre tt le temps
        }
        catch (Exception $e)
        {
            echo 'la base de donnée n\'a pas pu etre chargé';
            die('Erreur : ' . $e->getMessage()); // si ca marche pas ca dit qu'il y a une erreur
        }
        $req = $bdd->prepare("SELECT COUNT(*) FROM `contrat`"); // req contient une requette SQL
        $req->execute(); // On l'execute
        $nbr_contrat = $req->fetch(); //On transforme ca en donnees exploitable
        $nbr_contrat = $nbr_contrat['COUNT(*)'];

        for ($i=1; $i < $nbr_contrat +1 ; $i++) {
            $req = $bdd->prepare("SELECT idVendeur, speudo , ressource1, valeur1, ressource2, valeur2 FROM contrat INNER JOIN joueur ON idVendeur = joueur.idJoueur WHERE idContrat = $i"); // req contient une requette SQL
            $req->execute(); // On l'execute
            $donnees = $req->fetch();
            echo $donnees['speudo'], ' veut vendre ', $donnees['valeur1'],' ', $donnees['ressource1'], ' en echange de ', $donnees['valeur2'],' ', $donnees['ressource2']; ?><br><?php
          }?>

      </p>

        <h3>Il n'y a aucun contrat pour le moment.</h3>
    </body>
</html>
