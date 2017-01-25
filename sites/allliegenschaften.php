<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8"/>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title>Alle Immobilien</title>
</head>
<body>
<?php
include('../scripts/navigation.php');
include('../scripts/dbconnection.php');
?>
<h1>Alle Immobilien</h1>

<table class="table table-striped table-hover">
	<?php $result = $conn->query("
				  SELECT l.idliegenschaft, l.name, o.plz, o.ort 
				  FROM tbl_liegenschaft l 
				  INNER JOIN tbl_ort o 
				  ON l.idort = o.idort");
	?>
    <tr>
        <th>Liegenschafts-Nr</th>
        <th>Name</th>
        <th>PLZ</th>
        <th>Ort</th>
    </tr>
    <?php
	
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['idliegenschaft'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['plz'] . "</td>";
        echo "<td>" . $row['ort'] . "</td></tr>";
    }
    ?>
</table><br>
</body>
</html>