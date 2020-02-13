<?php
	require_once( '../../autoload.php' );

	$database = new Database( HOST, USER, PASS, DBNAME );

	$cateId = $_POST['cate_id'];

	$sql = "DELETE FROM cates WHERE cate_id = :cate_id;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$r = $query -> execute( array(
		':cate_id' => $cateId
	) );
	$r ? print( 'Thành công' ) : print( 'Thất bại' );
?>
