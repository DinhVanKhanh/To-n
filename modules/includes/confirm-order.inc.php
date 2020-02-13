<?php
	require_once( '../../autoload.php' );

	$database = new Database( HOST, USER, PASS, DBNAME );
	$conn = $database -> get_connection();
	if( isset($_POST['orderID'])){
		$sql = 'UPDATE orders SET order_completed = 1 WHERE order_id = :orderID;';
		$query = $conn->prepare($sql);
		$query->execute(array(
			'orderID' => $_POST['orderID']
		));

		print_r('Thao tác thành công!');
	};


?>
