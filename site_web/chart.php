<?php
	include("function_for_bdd.php");

	$idPlayer = $_GET["idPlayer"];

	$r_offre = "SELECT tour, valeur FROM `graphoffre` WHERE idJoueur = ?";
	$r_demande = "SELECT tour, valeur FROM `graphdemande` WHERE partie = (SELECT numeroPartie FROM joueur WHERE idJoueur = ?)";
	$points_offre = requestResultToArray(executeSQLRequest($r_offre, array($idPlayer)));
	$points_demande = requestResultToArray(executeSQLRequest($r_demande, array($idPlayer)));

	$dataPointsEnergyProduced = array();
	$dataPointsEnergyAsked = array();

	for ($i=0; $i < count($points_offre); $i++) {
		$arr = array('x' => $points_offre[$i][0], 'y' => $points_offre[$i][1]);
		array_push($dataPointsEnergyProduced, $arr);

		$arr = array('x' => $points_demande[$i][0], 'y' => $points_demande[$i][1]);
		array_push($dataPointsEnergyAsked, $arr);
	}
?>


<!DOCTYPE HTML>
<html>
    <head>
    <meta charset="UTF-8">
    <script>
        window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: false,
				backgroundColor: "rgba(214, 217, 217, 0.3)",
				title:{
					text: "Courbes"
				},
				axisX:{
					title: "Temps (Mois)"
				},
				axisY:{
					title: "Production (WhattMois)",
					titleFontColor: "#402813",
            		lineColor: "#402813",
            		labelFontColor: "#402813",
            		tickColor: "#402813"
				},
				axisY2:{
					title: "Demande (WhattMois)",
					titleFontColor: "#001545",
            		lineColor: "#001545",
            		labelFontColor: "#001545",
            		tickColor: "#001545"
				},
				data: [{
					type: "line",
					name: "Energie produite",
					markerSize: 0,
					toolTipContent: "Temperature: {x} °C <br>{name}: {y} mPa.s",
					showInLegend: true,
					dataPoints: <?php echo json_encode($dataPointsEnergyProduced, JSON_NUMERIC_CHECK); ?>
				},{
					type: "line",
					axisYType: "secondary",
					name: "Energie demandée",
					markerSize: 0,
					toolTipContent: "Temperature: {x} °C <br>{name}: {y} g/cm³",
					showInLegend: true,
					dataPoints: <?php echo json_encode($dataPointsEnergyAsked, JSON_NUMERIC_CHECK); ?>
				}]
			});
            chart.render();

        }
        </script>
    </head>
<body>
    <div id="chartContainer" style="height: 89vh; width: 97vw; overflow: hidden; border-radius: 5px;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
