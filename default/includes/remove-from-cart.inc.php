<?php

	require('../../autoload.php');

	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database->get_connection();

	$security = new Security();
	$security -> sec_session_start();

	if (isset($_SESSION['userCart'])){
		if ( array_search($_POST['removedProduct'], $_SESSION['userCart']) !== false ){
			$key = array_search($_POST['removedProduct'], $_SESSION['userCart']);
			unset($_SESSION['userCart'][$key]);

			$mediateArray = $_SESSION['userCart'];
			unset($_SESSION['userCart']);
			$sortedArray = array_values($mediateArray);
			$_SESSION['userCart'] = $sortedArray;


			header('Location: http://smartbrain.edu.vn/index.php?view=pay');

		} else {
			echo 'Khoa hoc khong ton tai trong gio hang';	
		};

	} else {
		echo 'Gio hang chua co san pham nao';
	};