<?php

include('dbconnection.php');

$error = '';

if(!empty(trim($_POST['aname']))){
    $aname = trim($_POST['aname']);
}else{
    $error .= "Name nicht definiert";
}



if(!empty(trim($_POST['tid']))){
    $tid = trim($_POST['tid']);
}else{
    $error .= "Typ ID nicht definiert";
}

if(empty($error)){
    $query1 = "INSERT INTO tbl_aufgabe(name, idtyp) 
                  VALUES (?, ?)";
    $stmt = $conn->prepare($query1);
    $stmt->bind_param("si", $aname, $tid);
    $stmt->execute();
}

$conn->close();

header('Location: ../sites/task.php?error='.$error);
?>