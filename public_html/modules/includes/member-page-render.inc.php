<?php
	require('../../autoload.php');
	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database -> get_connection();

	if (isset($_POST['pageNumber'])){

		$offsetNumber = ($_POST['pageNumber'] - 1) * 6;

		$sql = "SELECT * FROM end_users  ORDER BY created_at DESC LIMIT $offsetNumber , 6;";
		$query = $conn->prepare($sql);
		$query->execute();

		$result = $query->fetchAll();

		print_r(json_encode($result));
	}