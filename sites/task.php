<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8"/>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title>Neue Aufgabe</title>
</head>
<body>
<?php
    include('../scripts/navigation.php');
    include('../scripts/dbconnection.php');
?>
<h1>Neue Aufgabe</h1><br>

<form method="post" action="../scripts/newtask.php" name="newtask">
    <table class="table">
        <tr>
            <td>Aufgabenname: </td>
            <td><input type="text" class="form-control" name="aname" required></td>
        </tr>
        <tr>
            <td>Aufgabe-Typ: </td>
            <td>
            <?php $result = $conn->query("
                  SELECT idtyp, name 
                  FROM tbl_typ");
            ?>
            <select class="form-control" name='tid' required>
            <option value="" disabled selected>Typ auswählen</option>
            <?php
                while ($row = $result->fetch_assoc()) {
                $idtyp = $row['idtyp'];
                $name = $row['name'];
                echo "<option value='$idtyp'>$name</option>";
                }
            ?>
            </select>
            </td>
        </tr>
    </table>
    <button type="submit" class="btn btn-default">Neue Aufgabe erfassen</button><br><br>

    <?php
    if(!empty(trim($_GET['error']))) {
        $error = $_GET['error'];
        echo 'Error: ' . $error;
    }
    ?>

</body>
</html>
