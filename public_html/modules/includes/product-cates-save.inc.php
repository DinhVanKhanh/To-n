<?php
	require_once( '../../autoload.php' );

	if(isset($_POST['cate'])) {
		$database = new Database( HOST, USER, PASS, DBNAME );

		$cateName = $_POST['cate'];
		$cateId = $_POST['id'];

		$sql = "UPDATE product_cates SET cate_name = :cate_name WHERE cate_id = :cate_id;";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array(
			':cate_name' => $cateName,
			':cate_id' => $cateId
		) );
		$r ? print( 'Thành công' ) : print( 'Thất bại' );
	}
?>
