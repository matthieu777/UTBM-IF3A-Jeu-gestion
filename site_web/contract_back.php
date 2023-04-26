<?php

include("function_for_bdd.php");

if(isset($_POST["ressource1"])&& isset($_POST["valeur1"])&& isset($_POST["ressource2"])&& isset($_POST["valeur2"]))
{
  session_start();
  $ressource1 = $_POST["ressource1"];
  $ressource2 = $_POST["ressource2"];
  $valeur1 = $_POST["valeur1"];
  $valeur2 = $_POST["valeur2"];
  $player = $_GET["idPlayer"];
  echo $player;
  echo '<br>';
  $arr = array($player,$ressource1,$valeur1,$ressource2,$valeur2);
  echo var_dump($arr);
  echo '<br>';

  $req= executeSQLRequest("INSERT INTO `contrat` (`idVendeur`, `ressource1`, `valeur1`, `ressource2`, `valeur2`,`periode`,`duree`) VALUES (?,?,?,?,?,1,1); ",$arr);


}
?>
