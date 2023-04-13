
<?php


$message = '';

if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["pseudo"]) && isset($_POST["mail"]) && isset($_POST["mdp"])&& isset($_POST["mdpverif"]))
{
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $pseudo = $_POST["pseudo"];
    $email = $_POST["mail"];
    $mdp = $_POST["mdp"];
    $mdpverif = $_POST["mdpverif"];
    $mdpcrypte = password_hash($mdp, PASSWORD_DEFAULT);


    $bdd = new PDO("mysql:host=localhost;port=3306;dbname=projet_if_energie;charset=utf8", "root", "");




    $reqverifpseudo = $bdd->prepare("SELECT * FROM joueur WHERE pseudo = ?");
    
    $reqverifpseudo->execute([$pseudo]);

    if ($reqverifpseudo->fetch() == null ){
        $donneesreqverifpseudo = 0;
    } else {
        $donneesreqverifpseudo = 1; //si il est deja dans la base
    }

    
    $reqverifmail = $bdd->prepare("SELECT * FROM joueur WHERE email = ?");
    
    $reqverifmail->execute([$email]);

    if ($reqverifmail->fetch() == null ){
        $donneesreqverifmail = 0;
    } else {
        $donneesreqverifmail = 1; //si il est deja dans la base
    }


    

    if(($donneesreqverifpseudo ) != 0){

        echo"<p class = 'texteerreur' >Pseudo deja utilisé</p>";


    }

    else if (($donneesreqverifmail ) != 0){
        
                    
        echo"<p class = 'texteerreur' >Le mail existe deja</p>";
      } else if($mdp != $mdpverif ){



        echo"<p class = 'texteerreur' >Le mots de passe ne coresspond pas</p>";


      }
      
      
      else {
        
        
        $req = $bdd->prepare("insert into joueur (nom,prenom,pseudo,email,motDePasse) values (?,?,?,?,?)");
        $req->execute(array($nom , $prenom , $pseudo , $email ,  $mdpcrypte ));




       

        if ($req){
             
            
        echo"<p class = 'textereussi' >INSCRIPTION REUSSI</p>";


            

            
    
        } else {
    
            echo "<u><p >ERREUR </p></u>";
    
        }
    
    



      }

}

?>