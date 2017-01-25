<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8"/>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title>Neue Liegenschaft</title>
</head>
<body>
<?php
    include('../scripts/navigation.php');
    include('../scripts/dbconnection.php');
?>
<h1>Neue Liegenschaft</h1><br>

<form method="post" action="../scripts/newliegenschaft.php" name="newliegenschaft">
    <table class="table">
        <tr>
            <td>Liegenschaftsname: </td>
            <td><input type="text" class="form-control" name="lname" required></td>
        </tr>
				<?php $result = $conn->query("
                SELECT o.idort, o.plz, o.ort
				FROM tbl_ort o");
        ?>
		<tr>
			<td>Ort: </td>
			<td><select class="form-control" name='oid' required>
			<option value="" disabled selected>Ortschaft auswählen</option>
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
    <button type="submit" class="btn btn-default">Neue Liegenschaft erfassen</button>

    <?php
    if(!empty(trim($_GET['error']))) {
        $error = $_GET['error'];
        echo 'Error: ' . $error;
    }
    ?>

</body>
</html>


