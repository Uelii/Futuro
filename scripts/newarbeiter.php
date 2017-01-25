<?php

include('dbconnection.php');

$error = '';

if(!empty(trim($_POST['vname']))){
    $vname = trim($_POST['vname']);
}else{
    $error .= "Vorname nicht definiert";
}

if(!empty(trim($_POST['nname']))){
    $nname = trim($_POST['nname']);
}else{
    $error .= "Nachname nicht definiert";
}


if(!empty(trim($_POST['strasse']))){
    $strasse = trim($_POST['strasse']);
}else{
    $error .= "Strasse nicht definiert";
}

if(!empty(trim($_POST['oid']))){
    $oid = trim($_POST['oid']);
}else{
    $error .= "Ort nicht definiert";
}

if(empty($error)){
    $query1 = "INSERT INTO tbl_mitarbeiter(vorname, nachname, strasse, idort) 
                  VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query1);
    $stmt->bind_param("sssi", $vname, $nname, $strasse, $oid);
    $stmt->execute();
}

$conn->close();

header('Location: ../sites/arbeiter.php?error='.$error);
?>