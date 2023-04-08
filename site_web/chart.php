<?php
	include("function_for_bdd.php");

	$idPlayer = 1;
	$r = "SELECT tour, valeur FROM `graphoffre` WHERE idJoueur = ?";
	$points = requestResultToArray(executeSQLRequest($r, array($idPlayer)));

	$dataPointsEnergy = array();

	for ($i=0; $i < count($points); $i++) {
		$arr = array('x' => $points[$i][0], 'y' => $points[$i][1]);
		array_push($dataPointsEnergy, $arr);
	}
?>


<!DOCTYPE HTML>
<html>
    <head>
    <meta charset="UTF-8">
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
            	animationEnabled: true,
            	title:{
            		text: "Courbe d'offre de l'énergie"
            	},
            	axisX:{
            		title: "Mois"
            	},
            	axisY:{
            		title: "WhattMois",
            		titleFontColor: "#4F81BC",
            		lineColor: "#4F81BC",
            		labelFontColor: "#4F81BC",
            		tickColor: "#4F81BC"
            	},
            	data: [{
            		type: "line",
            		name: "Energie",
            		markerSize: 0,
            		toolTipContent: "Mois: {x} <br>{name}: {y} WhattMois",
            		dataPoints: <?php echo json_encode($dataPointsEnergy, JSON_NUMERIC_CHECK); ?>
            	}]
            });
            chart.render();

        }
        </script>
    </head>
<body>
    <div id="chartContainer" style="height: 100%; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
