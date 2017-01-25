<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8"/>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title>Neuer Mitarbeiter</title>
</head>
<body>
<?php
include('../scripts/navigation.php');
include('../scripts/dbconnection.php');
?>
<h1>Neuer Mitarbeiter</h1><br>

<form method="post" action="../scripts/newarbeiter.php" name="newarbeiter">
    <table class="table">
        <tr>
            <td>Vorname: </td>
            <td><input type="text" class="form-control" name="vname" required></td>
        </tr>
        <tr>
            <td>Nachname: </td>
            <td><input type="text" class="form-control" name="nname" required></td>
        </tr>
		<tr>
            <td>Strasse: </td>
            <td><input type="text" class="form-control" name="strasse" required></td>
        </tr>
		<tr>
		<?php $result = $conn->query("
                SELECT o.idort, o.plz, o.ort
				FROM tbl_ort o");
        ?>
			<td>Wohnort: </td>
			<td><select class="form-control" name='oid' required>
			<option value="" disabled selected>Ort auswählen</option>
			<?php
				while ($row = $result->fetch_assoc()) {
					$ido = $row['idort'];
					$plz = $row['plz'];
					$ort = $row['ort'];
					echo "<option value='$ido'>$plz $ort</option>";
				}
			?>
			</td>
		</tr>
    </table>
    <button type="submit" class="btn btn-default">Neuer Mitarbeiter anlegen</button>

    <?php
    if(!empty(trim($_GET['error']))) {
        $error = $_GET['error'];
        echo 'Error: ' . $error;
    }
    ?>

</body>
</html>
