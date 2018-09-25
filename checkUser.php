<?php
	session_start();
	require('../DBConnect.php');
	
	// print_r($_POST);
	$login = $_POST['login'];
	$password = $_POST['password'];
	
	$sql = "
		SELECT COUNT(*)
		FROM user_rapid
		WHERE login = $1
		AND password = $2
	";
	
	$tab = Array($login, $password);
	$result = pg_query_params($sql, $tab);
	
	list ($check) = pg_fetch_row($result);
	$return['check'] = $check;
	$return['php'] = phpversion();
	echo json_encode($return);
?>