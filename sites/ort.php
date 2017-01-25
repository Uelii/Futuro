<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8"/>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title>Neue Ortschaft</title>
</head>
<body>
<?php
    include('../scripts/navigation.php');
    include('../scripts/dbconnection.php');
?>
<h1>Neue Ortschaft</h1><br>

<form method="post" action="../scripts/newort.php" name="newort">
    <table class="table">
        <tr>
            <td>PLZ: </td>
            <td><input type="text" class="form-control" name="plz" required></td>
        </tr>
		<tr>
			<td>Ortschaftsname: </td>
			<td><input type="text" class="form-control" name="oname" required></td>
		</tr>
    </table>
    <button type="submit" class="btn btn-default">Neue Ortschaft eintragen</button>

    <?php
    if(!empty(trim($_GET['error']))) {
        $error = $_GET['error'];
        echo 'Error: ' . $error;
    }
    ?>

</body>
</html>


