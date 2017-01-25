<?php
	$server = '127.0.0.1';
	$database = 'futuro';
	$user = 'root';
	$password = '1234'; //Password gesetzt -> localhost bei Fabian

	$conn = new mysqli($server, $user, $password, $database);
	if($conn->connect_error){
		die('Verbindung fehlgeschlagen: '.$conn->connect_error);
	}
	$conn->set_charset("utf8");
?>