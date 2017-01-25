<?php

include('dbconnection.php');

$error = '';

if(!empty(trim($_POST['oname']))){
    $oname = trim($_POST['oname']);
}else{
    $error .= "Ortschaftsname nicht definiert";
}

if(!empty(trim($_POST['plz']))){
    $plz = trim($_POST['plz']);
}else{
    $error .= "PLZ nicht definiert";
}

if(empty($error)){
    $query1 = "INSERT INTO tbl_ort(plz, ort) 
                  VALUES (?, ?)";
    $stmt = $conn->prepare($query1);
    $stmt->bind_param("is", $plz, $oname);
    $stmt->execute();
}

$conn->close();

header('Location: ../sites/ort.php?error='.$error);

?>