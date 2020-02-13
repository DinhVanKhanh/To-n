<?php
	require_once( '../../autoload.php' );

	if(isset($_POST['id'])){
		$database = new Database( HOST, USER, PASS, DBNAME );

		$cateId = $_POST['id'];

		$sql = "DELETE FROM product_cates WHERE cate_id = :cate_id;";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array(
			':cate_id' => $cateId
		) );
		
		$r ? print('Thành công') : print( 'Thất bại' );
	}
?>
