<?php
	require_once( '../../autoload.php' );
	if( isset( $_POST['cate_name'] ) ) {

		$database = new Database( HOST, USER, PASS, DBNAME );

		$conn = $database -> get_connection();
		$sql = "INSERT INTO product_cates( cate_name ) VALUES ( :cate_name );";
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array(
			':cate_name' => $_POST['cate_name']
		) );
		$r ? print( 'Thành công' ) : print( 'Thất bại' );
	}
?>
