<?php
    include('dbconnection.php');

    $lid = $tid = $mid = $datum = $dauer = $bemerkung = $kosten = $error = '';

    if(!empty(trim($_POST['lid']))){
        $lid = trim($_POST['lid']);
    }else{
        $error .= "lid nicht definiert ";
    }

    $tid = $_POST['tid'];

    $mid = $_POST['mid'];

    if(!empty(trim($_POST['datum']))){
        $datum = trim($_POST['datum']);
    }else{
        $error .= "datum nicht definiert ";
    }

    if(!empty(trim($_POST['dauer']))){
        $dauer = trim($_POST['dauer']);
    }else{
        $error .= "dauer nicht definiert ";
    }
    $bemerkung = trim($_POST['bemerkung']);

    $kosten = trim($_POST['kosten']);

if(empty($error)){
    $query1 = "INSERT INTO tbl_verwaltung(datum, dauer, bemerkung, kosten, idliegenschaft)
               VALUES (?, ?, ?, ?, ?)";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param("sisdi", $datum, $dauer, $bemerkung, $kosten, $lid);
    $stmt1->execute();
}

if(empty($error)){
    $query2 = "SELECT idverwaltung
               FROM tbl_verwaltung
               WHERE datum = ? AND dauer = ? AND bemerkung = ? AND kosten = ? AND idliegenschaft = ?";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("sisdi", $datum, $dauer, $bemerkung, $kosten, $lid);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row2 = $result2->fetch_assoc();
    $vid = $row2['idverwaltung'];
}

if(empty($error)){
    foreach ($tid as $t){
        $query3 = "INSERT INTO tbl_verwaltung_aufgabe(idaufgabe, idverwaltung)
                   VALUES (?, ?)";
        $stmt3 = $conn->prepare($query3);
        $stmt3->bind_param("ii", $t, $vid);
        $stmt3->execute();
    }
}

if(empty($error)){
    foreach ($mid as $m){
        $query3 = "INSERT INTO tbl_verwaltung_mitarbeiter(idmitarbeiter, idverwaltung)
                    VALUES (?, ?)";
        $stmt3 = $conn->prepare($query3);
        $stmt3->bind_param("ii", $m, $vid);
        $stmt3->execute();
    }
}

$conn->close();

header("Location: ../sites/capturejob.php?error=".$error);

?>