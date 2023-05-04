<!DOCTYPE html>

<html>
<head>
	<title>Formulaire avec images en radio</title>
  <link rel="stylesheet" href="style/contract.css">
</head>
<body>
	<?php
		session_start();
		$idPlayer = $_GET["idPlayer"];
	?>

	<h2><u>Création d'un contrat :</u></h2>
	<?php
	echo'
	<form class = formulairecontract  action="contract_back.php?idPlayer='.$idPlayer.'" method="post">
    <div class= ensemble_image>
  		<input type="radio" id="dollar" name="ressource1" class="radio" value="dollar">
  		<label for="dollar"><img src="textures/dollar.png" alt="dollar"></label>

      <input type="radio" id="electricity" name="ressource1" class="radio" value="electricity">
      <label for="electricity"><img src="textures/electricity.png" alt="electricity"></label>

      <input type="radio" id="iron" name="ressource1" class="radio" value="iron">
  		<label for="iron"><img src="textures/iron.png" alt="iron"></label>

      <input type="radio" id="oil" name="ressource1" class="radio" value="oil">
  		<label for="oil"><img src="textures/oil.png" alt="oil"></label>

      <input type="radio" id="uranium" name="ressource1" class="radio" value="uranium">
  		<label for="uranium"><img src="textures/uranium.png" alt="uranium"></label>
    </div>

    <div class=inputensemble>
    <p>Recevoir :</p>
    <input class="valeur" type = "text" name = "valeur1" placeholder="Combien en voulez vous ?"/>
    </div>

    <div class= ensemble_image>

      <input type="radio" id="dollar2" name="ressource2" class="radio" value="dollar">
      <label for="dollar2"><img src="textures/dollar.png" alt="dollar"></label>

      <input type="radio" id="electricity2" name="ressource2" class="radio" value="electricity">
      <label for="electricity2"><img src="textures/electricity.png" alt="electricity"></label>

      <input type="radio" id="iron2" name="ressource2" class="radio" value="iron">
      <label for="iron2"><img src="textures/iron.png" alt="iron"></label>

      <input type="radio" id="oil2" name="ressource2" class="radio" value="oil">
      <label for="oil2"><img src="textures/oil.png" alt="oil"></label>

      <input type="radio" id="uranium2" name="ressource2" class="radio" value="uranium">

      <label for="uranium2"><img src="textures/uranium.png" alt="uranium"></label>
    </div>

    <div class=inputensemble>
    <p> Donner :</p>
    <input class="valeur" type = "text"  name ="valeur2" placeholder="Combien veux tu en donner ?"/>
    </div>

    <input class="boutonentretext" type="submit" value ="Valider">
	</form>'
	?>
</body>
</html>
