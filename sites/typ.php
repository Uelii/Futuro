<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8"/>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title>Neuer Typ</title>
</head>
<body>
<?php
    include('../scripts/navigation.php');
    include('../scripts/dbconnection.php');
?>
<h1>Neuer Typ</h1><br>

	<form method="post" action="../scripts/newtyp.php" name="newtyp">
    <table class="table">
        <tr>
            <td>Typ: </td>
            <td><input type="text" class="form-control" name="tname" required></td>
        </tr>
    </table><br>
	<button type="submit" class="btn btn-default">Neuer Typ erstellen</button>

    <?php
    if(!empty(trim($_GET['error']))) {
        $error = $_GET['error'];
        echo 'Error: ' . $error;
    }
    ?>
	
</body>
</html>
