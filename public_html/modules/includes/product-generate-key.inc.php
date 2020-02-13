<?php
	require_once( '../../autoload.php' );
	$database = new Database( HOST, USER, PASS, DBNAME );
	$conn = $database -> get_connection();
	$product_id = $_GET['id'];
	$product_name = $_GET['name'];
	$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

	$data = array(
		$product_name,
		$product_id,
		$order_id
	);

	echo json_encode($data);
?>
