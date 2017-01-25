<?php

include('dbconnection.php');

$error = '';

if(!empty(trim($_POST['tname']))){
    $tname = trim($_POST['tname']);
}else{
    $error .= "Name nicht definiert";
}

if(empty($error)){
    $query1 = "INSERT INTO tbl_typ(name) 
                  VALUES (?)";
    $stmt = $conn->prepare($query1);
    $stmt->bind_param("s", $tname);
    $stmt->execute();
}

$conn->close();

header('Location: ../sites/typ.php?error='.$error);
?>