<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet">
		<title>Liegenschaftsrapport</title>
	</head>
	<body>
		<?php
		include('../scripts/navigation.php');
		include('../scripts/dbconnection.php');
		?>
		<h1>Liegenschaftsrapport - Futuro Immobilien AG</h1><br>

		<table class="table" id="navi">
			<tr>
				<td>Name: </td>
				<td>
				<?php $result = $conn->query("SELECT l.idliegenschaft, l.name, o.plz, o.ort
						FROM tbl_liegenschaft l
						INNER JOIN tbl_ort o
						ON l.idort = o.idort"); 
				?>
				<select name='lid' id="lid" class="form-control">
				<option value="" disabled selected>Liegenschaft auswählen</option>
					<?php
					while ($row = $result->fetch_assoc()) {
						$idli = $row['idliegenschaft'];
						$name = $row['name'];
						$plz = $row['plz'];
						$ort = $row['ort'];
						echo "<option value='$idli'>$name, $plz $ort</option>";
					}
					?>
				</select>
				</td>
				<td><button type="button" id="show" class="btn btn-default">Arbeiten anzeigen</button></td>
			</tr>
		</table>
			<?php
			if(isset($_GET['lid'])){
				$lid = $_GET['lid'];
				if($lid !== "null"){
				$query = "	SELECT l.name, o.plz, o.ort
							FROM tbl_liegenschaft l
							INNER JOIN tbl_ort o
							ON l.idort = o.idort
							WHERE l.idliegenschaft = ?";
				$stmt = $conn->prepare($query);
				$stmt->bind_param("i", $lid);
				$stmt->execute();
				$result = $stmt->get_result();
				$row = $result->fetch_assoc();
				$liegen = $row['name'];
				$lplz = $row['plz'];
				$lort = $row['ort'];
				
				echo "<h3><p class='text-center'>" . $liegen . ", " . $lplz . " " . $lort . "</p></h3><br>";
				echo "<table>
						<tr class='text-right'>
							<td>Monatsauswahl</td>
							<td><input type='text' class='form-control'></td>
						</tr>
					</table>";
				}
			}
			?>
			<table class="table" id="liar">
				<tr>
					<th>Datum</th>
					<th>Person</th>
					<th>Art der Arbeit</th>
					<th>Zeit</th>
					<th>Kosten</th>
					<th>Material</th>
					<th>zusätzliche Arbeiten</th>
					<th>Bemerkung</th>
				</tr>
			<?php
			$queryr = "	SELECT idrapport, datum, zeit, kosten, material, zusaetzlicheArbeiten, bemerkung, idliegenschaft 
						FROM tbl_rapport
						WHERE idliegenschaft = ?";
			$stmtr = $conn->prepare($queryr);
			$stmtr->bind_param("i", $lid);
			$stmtr->execute();
			$resultr = $stmtr->get_result();
			while($rowr = $resultr->fetch_assoc()){
				$rid = $rowr['idrapport'];
				
				$query1 = "	SELECT datum, zeit, kosten, material, zusaetzlicheArbeiten, bemerkung
							FROM tbl_rapport
							WHERE idrapport = ?";
				$stmt1 = $conn->prepare($query1);
				$stmt1->bind_param("i", $rid);
				$stmt1->execute();
				$result1 = $stmt1->get_result();
				$row1 = $result1->fetch_assoc();
				
				$dat = $row1['datum'];
				echo "<tr><td>".date('d. m. Y', strtotime($dat))."</td>";
				
				$query2 = "SELECT rm.idmitarbeiter
						FROM tbl_rapport_mitarbeiter rm
						WHERE rm.idrapport = ?";
				$stmt2 = $conn->prepare($query2);
				$stmt2->bind_param("i", $rid);
				$stmt2->execute();
				$result2 = $stmt2->get_result();
				echo "<td>";
				while($row2 = $result2->fetch_assoc()){
					$mid = $row2['idmitarbeiter'];
					
					$query3 = "SELECT vorname, nachname
							FROM tbl_mitarbeiter
							WHERE idmitarbeiter = ?";
					$stmt3 = $conn->prepare($query3);
					$stmt3->bind_param("i", $mid);
					$stmt3->execute();
					$result3 = $stmt3->get_result();
					$row3 = $result3->fetch_assoc();
					echo $row3['vorname'] . " ";
					echo $row3['nachname'] . "<br>";
				}
				echo "</td>";


				$query4 = "SELECT ra.idaufgabe
							FROM tbl_rapport_aufgabe ra
							WHERE ra.idrapport = ?";
				$stmt4 = $conn->prepare($query4);
				$stmt4->bind_param("i", $rid);
				$stmt4->execute();
				$result4 = $stmt4->get_result();
				echo "<td>";
				while($row4 = $result4->fetch_assoc()){
					$aid = $row4['idaufgabe'];	
					
					$query5 = "SELECT name
							FROM tbl_aufgabe
							WHERE idaufgabe = ?";
					$stmt5 = $conn->prepare($query5);
					$stmt5->bind_param("i", $aid);
					$stmt5->execute();
					$result5 = $stmt5->get_result();
					$row5 = $result5->fetch_assoc();
					echo $row5['name'] . " ";				
				}
				
				echo "<td>" . $row1['zeit'] . " min </td>";
				echo "<td>" . $row1['kosten'] . " CHF </td>";
				echo "<td>" . $row1['material'] . "</td>";
				echo "<td>" . $row1['zusaetzlicheArbeiten'] . "</td>";
				echo "<td>" . $row1['bemerkung'] . "</td></tr>";	
			}
			?>
		</table><br>
		<table class="table">
			<tr>
				<td>Unterschrift</td>
				<td><input type="text" class="form-control"></td>
				<td><button type="button" id="print" class="btn btn-default">Drucken</button></td>
			</tr>
		</table><br>
		<!--
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="../js/sjscript.js"></script>-->

		<!-- Hinzugefügt von Fabian -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="../js/sjscript.js"></script>
		<script src="../js/showJobsOnDropdownChange.js"></script>
		<script>
			showJobsOnDropdownChange()
		</script>
	</body>
</html>