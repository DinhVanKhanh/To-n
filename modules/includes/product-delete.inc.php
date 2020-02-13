<?php
	require_once( '../../autoload.php' );

	if(isset($_POST['id'])){
		$database = new Database( HOST, USER, PASS, DBNAME );

		$productId = $_POST['id'];

		$sql = "DELETE FROM products WHERE product_id = :product_id;";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array(
			':product_id' => $productId
		) );

		$r ? print('Thành công') : print( 'Thất bại' );
	}
?>
