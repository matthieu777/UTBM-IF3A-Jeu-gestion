<!DOCTYPE html>

<html>
<head>
	<title>Formulaire avec images en radio</title>
	<style>
		/* Style pour ajouter un contour à l'image sélectionnée */
		.radio-img:checked + label img {
			border: 2px solid #736F3D;
		}
    img {
      width : 100px;
      height : 100px;
    }
	</style>
</head>
<body>
	<?php
		session_start();
		$idPlayer = $_GET["idPlayer"];
	?>

	<h2>Création d'un contrat</h2>
	<?php
	echo'
	<form action="contract_back.php?idPlayer='.$idPlayer.'" method="post">

  		<input type="radio" id="dollar" name="ressource1" class="radio-img" value="dollar">
  		<label for="dollar"><img src="textures/dollar.png" alt="dollar"></label>

      <input type="radio" id="electricity" name="ressource1" class="radio-img" value="electricity">
      <label for="electricity"><img src="textures/electricity.png" alt="electricity"></label>

      <input type="radio" id="iron" name="ressource1" class="radio-img" value="iron">
  		<label for="iron"><img src="textures/iron.png" alt="iron"></label>

      <input type="radio" id="oil" name="ressource1" class="radio-img" value="oil">
  		<label for="oil"><img src="textures/oil.png" alt="oil"></label>

      <input type="radio" id="uranium" name="ressource1" class="radio-img" value="uranium">
  		<label for="uranium"><img src="textures/uranium.png" alt="uranium"></label>
    <p>Valeur1:</p>
    <input class="valeur1" type = "text" name = "valeur1" placeholder="Combien en voulez vous ?"/>
    <br>

      <input type="radio" id="dollar2" name="ressource2" class="radio-img" value="dollar">
      <label for="dollar2"><img src="textures/dollar.png" alt="dollar"></label>

      <input type="radio" id="electricity2" name="ressource2" class="radio-img" value="electricity">
      <label for="electricity2"><img src="textures/electricity.png" alt="electricity"></label>

      <input type="radio" id="iron2" name="ressource2" class="radio-img" value="iron">
      <label for="iron2"><img src="textures/iron.png" alt="iron"></label>

      <input type="radio" id="oil2" name="ressource2" class="radio-img" value="oil">
      <label for="oil2"><img src="textures/oil.png" alt="oil"></label>

      <input type="radio" id="uranium2" name="ressource2" class="radio-img" value="uranium">

      <label for="uranium2"><img src="textures/uranium.png" alt="uranium"></label>
    <p>Valeur2:</p>
    <input class="valeur2" type = "text"  name ="valeur2" placeholder="Combien veux tu en donner ?"/>

    <input class="boutonentretext" type="submit" value ="Valider">
	</form>'
	?>
</body>
</html>
