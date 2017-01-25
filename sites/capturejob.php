<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8"/>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title>Neue Arbeit</title>
</head>
<body>
<?php
include('../scripts/navigation.php');
include('../scripts/dbconnection.php');
?>
<h1>Neue Arbeit</h1><br>

<form method="post" action="../scripts/capturejobsrc.php" name="capturejob">
    <table class="table">
        <tr>
            <td>Liegenschaft: </td>
            <td>
            <?php $result = $conn->query("
                SELECT l.idliegenschaft, l.name, o.plz, o.ort
				FROM tbl_liegenschaft l
				INNER JOIN tbl_ort o
				ON l.idort = o.idort");
            ?>
            <select class="form-control" name='lid' required>
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
        </tr>
        <tr>
            <td>Art der Arbeit: </td>
            <td>
                <?php $result = $conn->query("
                  SELECT a.idaufgabe, a.name
				  FROM tbl_aufgabe a");
                ?>
                <select class="form-control" name='tid[]' multiple required>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $idtask = $row['idaufgabe'];
                        $name = $row['name'];
                        echo "<option value='$idtask'>$name</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Mitarbeiter: </td>
            <td>
                <?php $result = $conn->query("
                  SELECT m.idmitarbeiter, m.vorname, m.nachname 
				  FROM tbl_mitarbeiter m");
                ?>
                <select class="form-control" name='mid[]' multiple required>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $idmit = $row['idmitarbeiter'];
                        $vorname = $row['vorname'];
                        $nachname = $row['nachname'];
                        echo "<option value='$idmit'>$vorname $nachname</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Datum: </td>
            <td><input type="date" class="form-control" name="datum" required></td>
        </tr>
        <tr>
            <td>Zeit(min): </td>
            <td><input type="text" class="form-control" name="zeit" required></td>
        </tr>
        <tr>
            <td>Kosten(CHF): </td>
            <td><input type="text" class="form-control" name="kosten"></td>
        </tr>
		<tr>
            <td>Material: </td>
            <td><input type="text" class="form-control" name="material"></td>
        </tr>
		<tr>
            <td>zusätzliche Arbeiten: </td>
            <td><input type="text" class="form-control" name="zuArbeit"></td>
        </tr>
		<tr>
            <td>Bemerkung: </td>
            <td><input type="text" class="form-control" name="bemerkung"></td>
        </tr>

    </table>
    <button type="submit" class="btn btn-default">Neue Arbeit erfassen</button>

    <?php
    if(!empty(trim($_GET['error']))) {
        $error = $_GET['error'];
        echo 'Error: ' . $error;
    }
    ?>

</body>
</html>
