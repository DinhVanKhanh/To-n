<?php
	require_once( '../../autoload.php' );

	$database = new Database( HOST, USER, PASS, DBNAME );

	$keyId = $_POST['id'];

	$sql = "DELETE FROM product_codes WHERE product_code_id = :id;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$r = $query -> execute( array(
		':id' => $keyId
	) );
	$r ? print( 'Thành công' ) : print( 'Thất bại' );
?>
