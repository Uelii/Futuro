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

    if(!empty(trim($_POST['zeit']))){
        $zeit = trim($_POST['zeit']);
    }else{
        $error .= "zeit nicht definiert ";
    }
	
	$kosten = trim($_POST['kosten']);
	
	$material = trim($_POST['material']);
	
	$zuArbeit = trim($_POST['zuArbeit']);
	
    $bemerkung = trim($_POST['bemerkung']);

if(empty($error)){
    $query1 = "INSERT INTO tbl_rapport(datum, zeit, kosten, material, zusaetzlicheArbeiten, bemerkung, idliegenschaft)
               VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param("sidsssi", $datum, $zeit, $kosten, $material, $zuArbeit, $bemerkung, $lid);
    $stmt1->execute();
}

if(empty($error)){
    $query2 = "SELECT idrapport
               FROM tbl_rapport
               WHERE datum = ? AND zeit = ? AND kosten = ? AND material = ? AND zusaetzlicheArbeiten = ? AND bemerkung = ? AND idliegenschaft = ?";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("sidsssi", $datum, $zeit, $kosten, $material, $zuArbeit, $bemerkung, $lid);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row2 = $result2->fetch_assoc();
    $rid = $row2['idrapport'];
}

if(empty($error)){
    foreach ($tid as $t){
        $query3 = "INSERT INTO tbl_rapport_aufgabe(idaufgabe, idrapport)
                   VALUES (?, ?)";
        $stmt3 = $conn->prepare($query3);
        $stmt3->bind_param("ii", $t, $rid);
        $stmt3->execute();
    }
}

if(empty($error)){
    foreach ($mid as $m){
        $query3 = "INSERT INTO tbl_rapport_mitarbeiter(idmitarbeiter, idrapport)
                    VALUES (?, ?)";
        $stmt3 = $conn->prepare($query3);
        $stmt3->bind_param("ii", $m, $rid);
        $stmt3->execute();
    }
}

$conn->close();

header("Location: ../sites/capturejob.php?error=".$error);

?>