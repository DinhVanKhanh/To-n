<?php
	require_once( '../../autoload.php' );

	$database = new Database( HOST, USER, PASS, DBNAME );
	$conn = $database -> get_connection();
	if( isset($_POST['orderID'])){
		$sql = 'DELETE FROM orders WHERE order_id = :orderID;';
		$query = $conn->prepare($sql);
		$query->execute(array(
			'orderID' => $_POST['orderID']
		));
	};


?>