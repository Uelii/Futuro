<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8"/>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title>Arbeit bearbeiten</title>
</head>
<body>
<?php
include('../scripts/navigation.php');
include('../scripts/dbconnection.php');
?>
<h1>Arbeit bearbeiten</h1>

<form method="post" action="../scripts/editjobsrc.php" name="editjob">
    <table>
        <tr>
            <td>Wo: </td>
            <td>
            <?php $result = $conn->query("
                SELECT idliegenschaft, name, plz, ort
                FROM liegenschaft");
            ?>
            <select name='lid' class="form-control">
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
            <td>Was: </td>
            <td>
                <?php $result = $conn->query("
                  SELECT idaufgabe, name 
                  FROM aufgabe");
                ?>
                <select name='tid[]' multiple required>
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
            <td>Wer: </td>
            <td>
                <?php $result = $conn->query("
                  SELECT idmitarbeiter, vorname, nachname 
                  FROM mitarbeiter");
                ?>
                <select name='mid[]' multiple required>
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
            <td>Wann: </td>
            <td><input type="date" name="datum" required></td>
        </tr>
        <tr>
            <td>Dauer(min): </td>
            <td><input type="text" name="dauer" required></td>
        </tr>
        <tr>
            <td>Bemerkung: </td>
            <td><input type="text" name="bemerkung"></td>
        </tr>
        <tr>
            <td>Kosten: </td>
            <td><input type="text" name="kosten"></td>
        </tr>

    </table><br>
    <input type="submit" value="Neue Arbeit erfassen"><br><br>

    <?php
    if(!empty(trim($_GET['error']))) {
        $error = $_GET['error'];
        echo 'Error: ' . $error;
    }
    ?>

</body>
</html>
