<!DOCTYPE html>

<?php
header("Refresh: 1");
session_start();
?>

<html>
  <head>
  </head>
  <body>
    <?php
    // Enregistrons les informations de date dans des variables
    $seconde = date("s");
    echo '<br><br><br><br>';
    echo $seconde;
    if($seconde == 59 or $seconde == 19 or $seconde == 39)
    { #pour s'assurer qu'il n'y ai pas plusieurs actualisation la meme seconde
      sleep(1);
      echo '1';
      include("function_for_bdd.php");
      executeSQLRequest("UPDATE map SET numeroTour = numeroTour + 1 WHERE idPartie = (SELECT numeroPartie FROM joueur WHERE pseudo = ?)", array($_SESSION['pseudo'] ));
      echo '
      <script type="text/javascript">
         parent.window.location.reload(true);
      </script>
      ';
    }
    ?>
  </body>
</html>
