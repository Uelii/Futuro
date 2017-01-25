<?php

include('dbconnection.php');

$error = '';

if(!empty(trim($_POST['lname']))){
    $lname = trim($_POST['lname']);
}else{
    $error .= "Liegenschaftsname nicht definiert";
}

if(!empty(trim($_POST['oid']))){
    $oid = trim($_POST['oid']);
}else{
    $error .= "OrtsID nicht definiert";
}


/*if(empty($error)){
	$query2 = "SELECT o.idort
	FROM tbl_ort o
	WHERE o.plz = ?";
	$stmt = $conn->prepare($query2);
	$stmt->bind_param("i", $plz);
	$stmt->execute();
	$row2 = $result2->fetch_assoc();
    $oid = $row2['idort'];
}*/

if(empty($error)){
    $query1 = "INSERT INTO tbl_liegenschaft(name, idort) 
                  VALUES (?, ?)";
    $stmt = $conn->prepare($query1);
    $stmt->bind_param("si", $lname, $oid);
    $stmt->execute();
}

$conn->close();

header('Location: ../sites/liegenschaft.php?error='.$error);

?>