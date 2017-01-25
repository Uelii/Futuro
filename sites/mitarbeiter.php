<?php
	include('../scripts/dbconnection.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet">
		<title>Mitarbeiter</title>
	</head>
	<body>
		<?php include('../scripts/navigation.php'); ?>
		<h1>Mitarbeiter</h1>
		
		<!--<form method="post" action="mitarbeiter.php" name="mitarbeiter">-->
		Name: <?php $result = $conn->query("SELECT idmitarbeiter, vorname, nachname FROM mitarbeiter"); ?>
				<select name='mid'>
				<?php 	while ($row = $result->fetch_assoc()) {
                        $mitid = $row['idmitarbeiter'];
						$vorname = $row['vorname'];
						$nachname = $row['nachname'];
						echo "<option value='$mitid'>$vorname $nachname</option>";
						}
				?>
				</select>
        <input type="submit" value="Anzeigen">
		<br><br>
        <?php

        $mid = @$_POST['mid'];

        $query2 = "SELECT datum, dauer, bemerkung, kosten FROM arbeit WHERE dauer = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $mid);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        echo "<table>
            <tr>
                <th>Datum</th>
                <th>Dauer</th>
                <th>Liegenschaft</th>
                <th>Aufgabe</th>
                <th>Bemerkung</th>
                <th>Kosten</th>
            </tr>";
            while ($row2 = $result2->fetch_assoc()) {
                $date = $row2['datum'];
                $day = substr($date,0,2);
                $month = substr($date,2,2);
                $year = substr($date,4,4);
                $datum = $day.".".$month.".".$year;
                $dauer = $row2['dauer']." Stunden";
                $liegenschaft = "";
                $aufgabe = "";
                $bemerkung = $row2['bemerkung'];
                $kosten = $row2['kosten']." CHF";

            echo "<tr>";
                echo "<td>" . $datum . "</td>";
                echo "<td>" . $dauer . "</td>";
                echo "<td>" . $liegenschaft . "</td>";
                echo "<td>" . $aufgabe . "</td>";
                echo "<td>" . $bemerkung . "</td>";
                echo "<td>" . $kosten . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        $conn->close(); ?>
	</body>
</html>		